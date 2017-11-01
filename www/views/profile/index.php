<?php
$user_presenter = new \www\presenters\UserPresenter();
$problem_presenter = new \www\presenters\ProblemPresenter();
?>

<div class="ui two column relaxed grid">
    <div class="four wide column">
        <div class="ui card">
            <div class="image">
                <img src="<?= $user_presenter->showAvatar($user->email) ?>">
            </div>
            <div class="content">
                <a class="header"><?= $user->nickname ?></a>
                <div class="meta">
                    <span class="date">@<?= $user->username ?></span>
                </div>
                <div class="description"><?= $user->bio ?></div>
            </div>
        </div>
        <div class="ui segment">
            <div class="ui list">
                <div class="item">
                    <i class="mail icon"></i>
                    <div class="content">
                        <a><?= $user_presenter->showEmailAddress($user->email) ?></a>
                    </div>
                </div>
                <div class="item">
                    <i class="linkify icon"></i>
                    <div class="content">
                        <a href="<?= $user_presenter->getWebsiteLink($user->website) ?>" target="_blank">
                            <?= $user_presenter->showWebsite($user->website) ?>
                        </a>
                    </div>
                </div>
                <div class="item">
                    <i class="users icon"></i>
                    <div class="content">Joined on <?= $user_presenter->showJointDate($user->created_at) ?></div>
                </div>
            </div>
        </div>
    </div>
    <div class="twelve wide column">
        <div class="ui segment">
            <div class="ui two column relaxed grid">
                <div class="eight wide column">
                    <canvas id="progress" width="100%" height="100%"></canvas>
                </div>
                <div class="eight wide column">
                    <canvas id="language" width="100%" height="100%"></canvas>
                </div>
            </div>
        </div>
        <div class="ui horizontal segments">
            <div class="ui center aligned segment">
                <div class="ui statistic">
                    <div class="value">
                        <?= $ac_problems ?> / <?= $all_problems ?>
                    </div>
                    <div class="label">
                        PROBLEM SOLVED
                    </div>
                </div>
            </div>
            <div class="ui center aligned segment">
                <div class="ui statistic">
                    <div class="value">
                        <?= $all_submissions ?>
                    </div>
                    <div class="label">
                        SUBMISSIONS
                    </div>
                </div>
            </div>
            <div class="ui center aligned segment">
                <div class="ui statistic">
                    <div class="value">
                        <?= $all_submissions == 0 ? '0.00' : number_format($ac_submissions * 100 / $all_submissions, 2) ?> %
                    </div>
                    <div class="label">
                        AC
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="<?= Yii::$app->params['staticFile']['ChartJs'] ?>"></script>
<script>
    var progress = new Chart('progress', {
        type: 'doughnut',
        data: {
            labels: [
                "In Queue",
                "Accepted",
                "Compile Error",
                "Runtime Error",
                "Time Limit Exceeded",
                "Memory Limit Exceeded",
                "Wrong Answer"
            ],
            datasets: [{
                data: [
                    <?= $status[\common\models\Submission::STATUS_QUEUE] ?? 0 ?>,
                    <?= $status[\common\models\Submission::STATUS_AC] ?? 0 ?>,
                    <?= $status[\common\models\Submission::STATUS_CE] ?? 0 ?>,
                    <?= $status[\common\models\Submission::STATUS_RE] ?? 0 ?>,
                    <?= $status[\common\models\Submission::STATUS_TLE] ?? 0 ?>,
                    <?= $status[\common\models\Submission::STATUS_MLE] ?? 0 ?>,
                    <?= $status[\common\models\Submission::STATUS_WA] ?? 0 ?>
                ],
                backgroundColor: [
                    "#252525",
                    "#21ba45",
                    "#fbbd08",
                    "#6435c9",
                    "#2185d0",
                    "#db2828",
                    "#a5673f"
                ]
            }]
        }
    });

    var language = new Chart('language', {
        type: 'bar',
        data: {
            labels: ["C", "C++", "Perl 6", "Python 3", "Java"],
            datasets: [{
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 206, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(153, 102, 255, 0.2)',
                    'rgba(255, 159, 64, 0.2)'
                ],
                borderColor: [
                    'rgba(255,99,132,1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(255, 159, 64, 1)'
                ],
                borderWidth: 1,
                data: [
                    <?= $language[\common\models\Submission::LANGUAGE_C] ?? 0 ?>,
                    <?= $language[\common\models\Submission::LANGUAGE_CPP] ?? 0 ?>,
                    <?= $language[\common\models\Submission::LANGUAGE_PERL6] ?? 0 ?>,
                    <?= $language[\common\models\Submission::LANGUAGE_PYTHON3] ?? 0 ?>,
                    <?= $language[\common\models\Submission::LANGUAGE_JAVA] ?? 0 ?>
                ]
            }]
        },
        options: {
            scales: {
                yAxes: [{
                    ticks: {beginAtZero: true}
                }]
            },
            legend: {display: false}
        }
    });
</script>