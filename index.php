<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="character_sheet.css">
        <title>DoD Character Sheet</title>
    </head>

    <?php
        $descriptors = array(
            "Släkte" => array( 
                                "Människa", "Halvling", "Dvärg", "Alv", "Vargfolk" 
            ),

            "Ålder" => array( 
                                "Ung", "Medelålders", "Gammal" 
            ),

            "Svaghet" => array(
                                "Ingen", "Godtrogen", "Girig", "Lättkränkt", "Dumdristig", "Räddhågsen", "Monsterhatare", "Intolerant",
                                "Lättjefull", "Matglad", "Kleptoman", "Fåfäng", "Våghals", "Arkanofob", "Bokmal", "Vilde",
                                "Skrävlare", "Våldsam", "Besserwisser", "Pessemist", "Högfärdig"
            )
        );

        $equipment_slots = array(
            "Armor" => array (
                "defenseValue", 
                "negativeAttributes" => array(
                    "sneak" => boolval(FALSE),
                    "dodge" => boolval(TRUE),
                    "movement" => boolval(TRUE)
                ) 
            ),

            "Helmet" => array (
                "defenseValue", 
                "negativeAttributes" => array(
                    "dangersense" => boolval(TRUE),
                    "rangedAttack" => boolval(FALSE)
                ) 
            )
        );

        $keepsakes = array(
            "keepsake1", "keepsake2", "keepsake3", "keepsake4", "keepsake5"
        );

        $chr_stats = array(
            "STY", "FYS", "SMI", "INT", "PSY", "KAR"
        );

        $weapons = array(
            "dolk" => array(
                "1H", "2", "1D", "3", "ful som fan"
            ),

            "stenklubba" => array(
                "2H", "5", "7D", "15", "stor :-)"
            )
        );

        $SkillTypes = array(
            $BaseSkills = array("Bskill1", "Bskill2", "Bskill3", "Bskill4", "Bskill5", "Bskill6", "Bskill7", "Bskill8", "Bskill9", "Bskill10"), 
            $WeaponSkills = array("Wskill1", "Wskill2", "Wskill3", "Wskill4", "Wskill5", "Wskill6"), 
            $SecondarySkills = array("Sskill1", "Sskill2", "Sskill3")
            
        );
    ?>  

  <body>
    <div class="character-sheet">
        <div class="description-container">
            <div class="Name">Namn: </br><textarea></textarea></div>
            <div class="Title">Titel/Alias: </br><textarea></textarea></div>

            <?php
                foreach ($descriptors as $category => $options) {
                    echo "
                    <div class='$category'> 
                        $category <input type='text' list='$category'><datalist id='$category'>";
                    
                    foreach ($options as $option) {
                        echo "<option>$option</option>";
                    }
                            
                    echo "</datalist>
                    </div>";
                }
            ?>
            <div class="weakness-desc">weakness description</div>
        </div>

        <div class="condition-container">
            <div class="mp">
                Viljepoäng: <textarea></textarea>
            </div>
            <div class="hp">
                Kroppspoäng: <textarea></textarea>
            </div>
            <div class="fatal-blows">
                Dödsslag: 
                <div>Lyckade: <input type='checkbox'><input type='checkbox'><input type='checkbox'></div>
                <div>Misslyckade: <input type='checkbox'><input type='checkbox'><input type='checkbox'></div>
            </div>
        </div>

        <div class="equipment-container">   
            <?php
                foreach ($equipment_slots as $equipment => $slot) {
                    echo "
                    <div class='$equipment equipment'> 
                        $equipment <textarea></textarea>";
                        foreach ($slot as $value => $attributes) {
                            if ($attributes != end($slot)) {
                                echo "$attributes ";
                            }
                            elseif ($attributes == end($slot)) {
                                echo "</br><div class='negativeAttribute'>$value:";
                                foreach($attributes as $attribute => $boolvalue) {
                                    echo"<div class='$attribute'>$attribute<input type='checkbox' ";
                                    if ($boolvalue == TRUE) {
                                        echo"checked>";
                                    }
                                    elseif ($boolvalue == FALSE) {
                                        echo">";
                                    }
                                    echo"</div>";
                                }
                                echo"</div>";     
                            }
                        }
                    echo"</div>"; 
                } 
            ?>
        </div>

        <div class="miscitems-container">
            Småsaker
            <div id="misc-item-text-container">
                <textarea></textarea>
            </div>
            <button id="misc-item-btn">+</button>
        </div>
        
        <div class="keepsake-container">
            <input type='text' list='keepsakes'>
                <datalist id='keepsakes'>
                    <?php foreach ($keepsakes as $keepsake): ?>
                            <option><?= $keepsake ?></option>";
                    <?php endforeach; ?>
                    
                </datalist>
            </input>
            <div class="keepsake-description">keepsake description</div>
        </div>

        <div class="characteristics-container">
            <?php
                foreach ($chr_stats as $index => $stat) {
                    echo "<div class='stat $stat'>
                        $stat
                        <textarea rows='1' cols='1'></textarea>
                    </div>";
                }
            ?>
        </div>

        <div class="weapons-container">
            <table class="weapons-table">
                <tr>
                    <th>Vapen/Sköld</th>
                    <th>Grepp</th>
                    <th>Räckvidd</th>
                    <th>Skada</th>
                    <th>Brytvärde</th>
                    <th>Egenskaper</th>
                </tr>
                
                <?php 
                    $weaponProperties = array(
                        "grip", "reach", "damage", "breakValue", "properties"
                    );
                
                for ($rowIndex = 0; $rowIndex < 3; $rowIndex++): ?>
                <tr>
                    <td>
                        <input class="equipped-weapon" type="text" list="weapons-<?= $rowIndex ?>" oninput="updateWeaponData(this, <?=$rowIndex?>)">
                        <datalist id="weapons-<?=$rowIndex?>">
                                <?php foreach ($weapons as $weapon => $data): ?>
                                    <option value="<?= $weapon ?>"></option>
                                <?php endforeach; ?>
                            </datalist>
                        </input>
                    </td>
                        <?php foreach ($weaponProperties as $weaponProperty): ?>
                        <td>
                            <input type="text" id="<?= $weaponProperty ?>-<?= $rowIndex ?>"></input>
                        </td>
                        <?php endforeach; ?>
                    </tr>
                <?php endfor; ?>
            </table>
        </div>
        
        <div class="skill-container">
            <?php
                foreach ($SkillTypes as $type => $SkillList) {
                    echo "<div class='$type-container'>";
                        foreach ($SkillList as $skill) {
                            echo "<div class='skill'>
                            <input type='checkbox'><textarea>__</textarea><a>$skill</a></br>
                            </div>";
                    }
                echo "</div>";
                }
            ?>
                </div>
            </div>

        <div class="divider">
            <div class="Skadebonus">
                <?php
                    $bdmg_stats = array("STY", "SMI");

                    foreach ($bdmg_stats as $stat) {
                        echo "<div class='bdmg $stat'>
                            Skadebonus $stat:
                            <textarea></textarea>
                        </div>";
                    }
                ?>
            </div>

            <div class="movement">
                Förflyttning: <textarea value="Byt ut med nummer"></textarea>
            </div>
        </div>

        <div class="container"> 
            <div class="left-container">
                <div class="ability-container">
                Förmågor & Besvärjelser     
                    <div id="abilities">
                        <textarea></textarea>
                        <textarea></textarea>
                        <textarea></textarea>
                        <textarea></textarea>
                        <textarea></textarea>
                        <textarea></textarea>
                        <textarea></textarea>
                        <textarea></textarea>
                    </div>
                    <button id="add-ability">+ Lägg till ny förmåga</button>
                </div>

                <div class="money-container">
                <?php 
                    $coin_types = array("Guld", "Silver", "Koppar" );

                    foreach ($coin_types as $coin_type) {
                        echo "<div class='$coin_type'>
                            $coin_type mynt: <textarea type='number' class='$coin_type'></textarea>
                        </div>";
                    }
                ?>
                </div>
            </div>
            
        
        </div>
    </div>

    <script src="script.js"></script>
    </body>
  </html>