<?php

namespace www\filters;

use bandwidthThrottle\tokenBucket\Rate;
use bandwidthThrottle\tokenBucket\storage\SessionStorage;
use bandwidthThrottle\tokenBucket\TokenBucket;
use Yii;
use yii\base\ActionFilter;
use yii\web\Response;

class SubmitRateLimiterFilter extends ActionFilter {
    public function beforeAction($action) {
        $bucket = new TokenBucket(
            Yii::$app->params['tokenBucketCapacity'],
            new Rate(Yii::$app->params['tokenRatePerMinute'], Rate::MINUTE),
            new SessionStorage("rate_limiter")
        );
        $bucket->bootstrap(Yii::$app->params['tokenBootstrap']);

        if (!$bucket->consume(1, $seconds)) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            echo json_encode([
                'message' => 'too many requests',
                'code' => 255
            ]);
            return false;
        }
        return parent::beforeAction($action);
    }
}