<!DOCTYPE html>
<html>
 <head>
    <meta charset="utf-8">
    <title>Login page</title>
    <meta name="description" content="login page">
    <link rel="stylesheet" href="<?php echo PATH_MEDIAS_CSS ?>backoffice.css">
 </head>
 <body>
  <div class="page close">
    <section class="content">
        <?php $config = [
                "struct" => [
                    "method" => "POST",
                    "action" => URL_WEBSITE_ADMIN."index/login",
                    "class"  => "form-group",
                    "submit" => "S'inscrire",
                ],
                "data" => [
                    "email" => [
                        "type"        => "email",
                        "placeholder" => "test@gmail.com",
                        "label"       => "Votre email",
                        "required"    => true
                    ],
                    "password" => [
                        "type"        => "password",
                        "placeholder" => "",
                        "label"       => "Password",
                        "required"    => true
                    ]
                ]
            ];
        ?>
        <h1>login page</h1>
        <form method="<?php echo $config["struct"]["method"];?>"
              action="<?php echo $config["struct"]["action"];?>">

            <?php foreach ($config["data"] as $name => $attributs):?>

                <?php if(in_array($attributs["type"], ["email","text", "password"])) :?>

                    <input type="<?php echo $attributs["type"];?>"
                           name="<?php echo $name;?>"
                           placeholder="<?php echo $attributs["placeholder"];?>"
                        <?php echo $attributs["required"]?"required='required'":"";?>
                    ><br>

                <?php endif;?>

            <?php endforeach; ?>
            <input type="submit" value="<?php echo $config["struct"]["submit"];?>" >

        </form>
    </section>
  </div>

 <!-- jquery-2.2.4 -->
 <script
        src="https://code.jquery.com/jquery-2.2.4.min.js"
        integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44="
        crossorigin="anonymous"></script>
 </body>
</html>
