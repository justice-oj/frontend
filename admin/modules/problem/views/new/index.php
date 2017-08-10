<link href="https://cdn.quilljs.com/1.3.1/quill.snow.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/KaTeX/0.7.1/katex.min.css" rel="stylesheet">
<script src="https://cdn.quilljs.com/1.3.1/quill.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/KaTeX/0.7.1/katex.min.js"></script>

<div id="form-container" class="container">
    <form>
        <div class="row">
            <div class="col-xs-8">
                <div class="form-group">
                    <label for="display_name">Display name</label>
                    <input class="form-control" name="display_name" type="text" value="Wall-E">
                </div>
                <div class="form-group">
                    <label for="location">Location</label>
                    <input class="form-control"  name="location" type="text" value="Earth">
                </div>
            </div>
        </div>
        <div class="row form-group">
            <label for="about">Description</label>
            <input name="about" type="hidden">
            <div id="editor-container">
                <p>A robot who has developed sentience, and is the only robot of his kind shown to be still functioning on Earth.</p>
            </div>
        </div>
        <div class="row">
            <button class="btn btn-primary" type="submit">Save Profile</button>
        </div>
    </form>
</div>
<script>
    var quill = new Quill('#editor-container', {
        modules: {
            toolbar: [
                ['bold', 'italic', 'underline', 'strike'],        // toggled buttons
                ['blockquote', 'code-block'],
                [{ 'header': 1 }, { 'header': 2 }],               // custom button values
                [{ 'list': 'ordered'}, { 'list': 'bullet' }],
                [{ 'script': 'sub'}, { 'script': 'super' }],      // superscript/subscript
                [{ 'indent': '-1'}, { 'indent': '+1' }],          // outdent/indent
                [{ 'size': ['small', false, 'large', 'huge'] }],  // custom dropdown
                [{ 'header': [1, 2, 3, 4, 5, 6, false] }],
                ['formula'],
                ['clean']                                         // remove formatting button
            ]
        },
        placeholder: 'Add your problem here...',
        theme: 'snow'
    });

    var form = document.querySelector('form');
    form.onsubmit = function() {
        // Populate hidden form on submit
        var about = document.querySelector('input[name=about]');
        about.value = JSON.stringify(quill.getContents());

        console.log("Submitted", $(form).serialize(), $(form).serializeArray());

        // No back end to actually submit to!
        alert('Open the console to see the submit data!')
        return false;
    };
</script>
