<!DOCTYPE html>
<!--tip.php-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Tip</title>
    </head>
    <body>
        <h1>TIP 1</h1>
        <p>Maak gebruik van CSS-eigenschappen om de grootte van de letters aan te passen.</p>

        <br /><br /><br />
        <hr />

        <h1>TIP 2</h1>
        <p>Bekijk onderstaande code:</p>
        <pre>
            &lt;?php
            $grootte = 30;
            ?&gt;
            &lt;span style="font-size:&lt;?php print($grootte); ?&gt;px"&gt;Tekst&lt;/span&gt;
        </pre>

        <p>Na het invullen van de grootte vertaalt het bovenstaande zich uiteindelijk naar de volgende HTML-code:</p>
        <pre>
            &lt;span style="font-size: 30px"&gt;Tekst&lt;/span&gt;
        </pre>
    </body>
</html>
