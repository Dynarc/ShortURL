<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ShortURL</title>
</head>
<body>
    <h1>ShortURL</h1>
    <form action="<?=URL?>" method="POST">
        <label for="url">URL à raccourcir</label>
        <input type="text" id="url" name="url" required>

        <input type="submit" value="Générer">
    </form>

    <hr>

    <result></result>

    <script>
        let resultBox = document.querySelector('result');
        let form = document.querySelector('form');
        let input = document.querySelector('input');
        function getURL() {
            fetch('<?=URL?>' + '?url=' + input.value, {
                method: 'GET',
            }).then(function(response) {
                return response.text();
            }).then(function(text) {
                if(/^https?:\/\/(www.)?[a-z]+.[a-z0-9]+\/[a-z0-9]{6}$/.test(text)) {
                    resultBox.innerHTML = 'URL : ' + '<span onClick="copy()" style="cursor: pointer">' + text + "</span>";
                } else {
                    resultBox.innerHTML = 'error';
                }
            });
        }

        form.addEventListener('submit', function(e) {
            e.preventDefault();
            getURL();
        });
        function copy() {
            let span = document.querySelector('span');
            navigator.clipboard.writeText(span.innerHTML);
        }

    </script>
</body>
</html>