<?php
require_once(__DIR__ . '/../../../../../csp_config.php');
?>
<div class="centrage">
    <p>----------------------------------------------------------------------------------------------------</p>
    <p class="red">ATTENTION VEUILLEZ BIEN CHOISIR VOTRE MOT DE PASSE</p>
    <p class="red">SEULEMENT POUR LES DEVELOPPEURS!!!</p>
    <p>----------------------------------------------------------------------------------------------------</p>

    <h2>Ajouter un mdp pour l'url à chiffré</h2>

    <form method="post">

        <label for="mdp">mdp :</label>
        <div class="coteAcote">
        <input type="password" id="mdp" name="mdp" required>
            <div class="coteAcote">
                <div>
        <input type="checkbox" id="toggleMdp">
                </div>
                <div>
                <p>Afficher le mot de passe</p>
            </div>
                </div>
        </div>
        <button type="submit" name="ok">Envoyer</button>
    </form>


    <h2>Modification du mdp pour l'url à chiffré</h2>

    <form method="post">


            <label for="ancienmdp">Ancien mdp :</label>
        <div class="coteAcote">
            <input type="password" id="ancienmdp" name="ancienmdp" required>
            <div class="coteAcote">
            <div>
            <input type="checkbox" id="toggleAncienMdp">
            </div>
                <div>
                <p>Afficher le mot de passe</p>
                </div>
            </div>
        </div>

            <label for="newmdp">Nouveau mdp :</label>
        <div class="coteAcote">
            <input type="password" id="newmdp" name="newmdp" required>
            <div class="coteAcote">
                <div>
            <input type="checkbox" id="toggleNewMdp">
                </div>
                <div>
                    <p>Afficher le mot de passe</p>
            </div>
            </div>
        </div>


             <label for="confmdp">Confirmer Nouveau mdp :</label>
        <div class="coteAcote">
             <input type="password" id="confmdp" name="confmdp" required>
            <div class="coteAcote">
                <div>
            <input type="checkbox" id="toggleConfMdp">
                </div><div>
                    <p>Afficher le mot de passe</p>
                </div>
        </div>
        </div>

        <button type="submit" name="modifier">Envoyer</button>
    </form>

</div>



