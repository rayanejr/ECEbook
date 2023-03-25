<?php

include("data.php");

if (isset($_POST['input'])){
    $input = $_POST['input']; 

    $req = "SELECT * FROM utilisateur WHERE pseudo LIKE '{$input}%'";
    $res = mysqli_query($conn, $req);

    if (mysqli_num_rows($res) > 0){?>
        <table style="margin-left: 46%; margin-top: 40px;">
            <thead class="col-6 col-md-4">
                <th>Utilisateurs</th>
            </thead>
            <tbody>
                <?php
                while ($row = mysqli_fetch_assoc($res)){
                    $nom = $row['nom'];
                    $prenom = $row['prenom'];
                    $pseudo = $row['pseudo'];

                    ?>

                    <tr>
                        <td>
                            <?php echo $nom;?>
                            <?php echo $prenom;?>
                            <?php echo $pseudo;?>
                            <a href="../model/envoie_mail_subs.php?id_abonné=<?php echo $row['id_user']?>">
                            <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" class="bi bi-person-fill-add" viewBox="0 0 16 16">
                                <path d="M12.5 16a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7Zm.5-5v1h1a.5.5 0 0 1 0 1h-1v1a.5.5 0 0 1-1 0v-1h-1a.5.5 0 0 1 0-1h1v-1a.5.5 0 0 1 1 0Zm-2-6a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"/>
                                <path d="M2 13c0 1 1 1 1 1h5.256A4.493 4.493 0 0 1 8 12.5a4.49 4.49 0 0 1 1.544-3.393C9.077 9.038 8.564 9 8 9c-5 0-6 3-6 4Z"/>
                            </svg>
                            </a>
                        </td>
                    </tr>
                    <?php
                }
                ?>
                <?=include("footer.php")?>
            </tbody>
        </table>

        <?php
    } else {
        echo "No data found";
    }
}
?>

<style>
    svg:hover{
        color: green;
    }
</style>

