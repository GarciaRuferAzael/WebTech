<?php $articoloid=$templateParams["articolo"]; ?>
        <article>
            <header>
                <div>
                    <img src="<?php echo UPLOAD_DIR.$articoloid["imgarticolo"]; ?>" alt="" />
                </div>
                <h2><?php echo $articoloid["titoloarticolo"]; ?></h2>
                <p><?php echo $articoloid["dataarticolo"]; ?> - <?php echo $articoloid["nome"]; ?></p>
            </header>
            <section>
                <p><?php echo $articoloid["testoarticolo"]; ?></p>
            </section>
        </article>