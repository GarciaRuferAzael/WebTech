<section>
            <h2>Autori del Blog</h2>
            <table>
                <tr>
                    <th id="autore">Autore</th><th id="email">Email</th><th id="argomenti">Argomenti</th>
                </tr>
                <?php foreach($templateParams["contatti"] as $contatto): ?>
                <tr>
                    <th id="autore"><?php echo getIdFromName($contatto["nome"]); ?></th><th id="email"><?php echo $contatto["username"]; ?></th><th id="argomenti"><?php echo $contatto["argomenti"]; ?></th>
                </tr>
                <?php endforeach ?>
            </table>
        </section>