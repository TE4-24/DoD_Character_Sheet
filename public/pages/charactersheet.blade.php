<!DOCTYPE html>
<html lang="en" class="font-['Franklin_Gothic_Medium',_'Arial_Narrow',_Arial,_sans-serif]">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="output.css">
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
            "BaseSkills" => array("Bskill1", "Bskill2", "Bskill3", "Bskill4", "Bskill5", "Bskill6", "Bskill7", "Bskill8", "Bskill9", "Bskill10"), 
            "WeaponSkills" => array("Wskill1", "Wskill2", "Wskill3", "Wskill4", "Wskill5", "Wskill6"), 
            "SecondarySkills" => array("Sskill1", "Sskill2", "Sskill3")
        );
    ?>  

  <body class="m-0 mt-[1%] ml-[1%]">
    <div id="character-sheet" class="flex flex-wrap">



        <div id="description-container" class="w-[20vw] min-w-[200px] flex flex-col mb-[2%]">
            <div class="mb-[10px]">
                Namn: </br>
                <textarea maxlength="30" class="text-[1.1rem] w-[90%]"></textarea>
            </div>
            <div class="mb-[10px]">
                Titel/Alias: </br>
                <textarea maxlength="30" class="text-[1.1rem] w-[90%]"></textarea>
            </div>

            @foreach ($descriptors as $category => $options)
                <div class='{{ $category }}'> 
                    {{ $category }} 
                    <input type='text' list='$category'>
                        <datalist id='$category'>";
                            @foreach ($options as $option)
                                <option>{{ $option }}</option>"
                            @endforeach    
                        </datalist>
                    </div>
            @endforeach
            
            <div id"weakness-desc">weakness description</div>
        </div>



        <div id="condition-container" class="w-[20vw] min-w-[200px] flex flex-col text-[large]">
            <div id="stat mp" class="bg-[aquamarine] p-[4%]">
                <span>Viljepoäng: </span><textarea maxlength="4" text-center w-[10%] p-0></textarea>
            </div>
            <div id="stat hp" class="bg-[darkred] p-[4%]">
                Kroppspoäng: <textarea maxlength="4"></textarea>
            </div>
            <div id="fatal-blows" class="mt-[2%] bg-[rebeccapurple] p-[4%]">
                <p class="mt-0 text-center w-full">Dödsslag: </p> 
                <div>Lyckade: <input type='checkbox'><input type='checkbox'><input type='checkbox'></div>
                <div>Misslyckade: <input type='checkbox'><input type='checkbox'><input type='checkbox'></div>
            </div>
        </div>



        <div id="equipment-container" class="flex flex-col w-[20vw] min-w-[200px] ml-[2%]">   
            <?php
                foreach ($equipment_slots as $equipment => $slot) {
                    echo "
                    <div id='$equipment' class='w-full h-1/2 bg-[gray] p-[2%] mb-[1%]'> 
                        <p class='m-0 w-full'>$equipment </p><textarea class='w-2/5'></textarea>";
                        foreach ($slot as $value => $attributes) {
                            if ($attributes != end($slot)) {
                                echo "<p id='defenseValue'>$attributes </p>";
                            }
                            elseif ($attributes == end($slot)) {
                                echo "</br><div class='flex w-full'>$value:";
                                foreach($attributes as $attribute => $boolvalue) {
                                    echo"<div id='$attribute'>$attribute<input type='checkbox' ";
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



        <div id='miscitem-container' class="ml-[2%] w-[10vw] min-w-[200px] bg-[brown] p-[0.5%]">
            Småsaker
            <div id="misc-item-text-container">
                <textarea></textarea>
            </div>
            <button id="misc-item-btn">+</button>
        </div>
        
        <div id='keepsake-container' class="ml-[1%] min-w-[200px] w-[15vw]">
            <p class="m-0">Minnessak</p>
            <input type='text' list='keepsakes'>
                <datalist id='keepsakes'>
                    <?php foreach ($keepsakes as $keepsake): ?>
                            <option><?= $keepsake ?></option>";
                    <?php endforeach; ?>
                </datalist>
            </input>
            <input id="keepsake-description" type='text' value="keepsake-description" class="w-full h-2/5" ></input>
        </div>
        

        
        <div id="characteristics-container" class="w-[40vw] min-w-[400px]">
            <div id="stat-container" class="relative flex justify-center text-center leading-[4vh] gap-[15px]">
            <?php
                foreach ($chr_stats as $index => $stat) {
                    echo "<div id='$stat stat' class='border-[1px] border-[black] border-[solid] rounded-[50%] bg-[rgb(253,_91,_140)] box-border h-[5vw] w-[5vw] min-h-[50px] min-w-[50px]'>
                        $stat
                        <textarea rows='1' cols='1' class='bg-transparent border-transparent w-full p-0 text-[1.4rem] text-center focus:outline-none focus:ring-0'></textarea>
                    </div>";
                }
            ?>
            </div>


            <div id="separate-container" class="w-full flex justify-center mt-[1%] text-center gap-[45px]">
                <div id="stat-container" class="flex gap-[45px]">
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

                <div id="movement">
                    Förflyttning: <textarea value="Byt ut med nummer"></textarea>
                </div>
            </div>
        </div>



        <div id="weapons-container" class="w-[58vw]">
            <table id="weapons-table" class="w-full [border-spacing:0] border-[1px] border-[black] border-[solid]">
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
        


        <div id="skill-type-container" class="flex flex-col flex-wrap w-[30vw] h-[40vh]">
            <?php
                foreach ($SkillTypes as $type => $SkillList) {
                    echo "<div id='skill-container' class='flex flex-col flex-wrap h-min mr-[10px]'>
                        <span>$type</span>";
                        foreach ($SkillList as $skill) {
                            echo "<div id='skill' class='flex'>
                            <input type='checkbox'><textarea class='w-8'></textarea><a>$skill</a></br>
                            </div>";
                    }
                echo "</div>";
                }
            ?>
                </div>

        <div id="ability-container" class="w-[25vw]">
            <p class="h-auto w-full text-center">Förmågor & Besvärjelser</p>     
                <div id="abilities" class="w-[45%]">
                    <textarea></textarea>
                    <textarea></textarea>
                    <textarea></textarea>
                    <textarea></textarea>
                    <textarea></textarea>
                    <textarea></textarea>
                    <textarea></textarea>
                    <textarea></textarea>
                </div>
                <button id="add-ability" class="flex relative right-[0]">+ Lägg till ny förmåga</button>
            </div>



            <div #id="inventory-container" class="w-[40vw] h-[60vh]">
                <p class="h-auto w-full text-center">Ryggsäck</p>     
                    <div id="item-container">
                        <textarea></textarea>
                        <textarea></textarea>
                        <textarea></textarea>
                        <textarea></textarea>
                        <textarea></textarea>
                        <textarea></textarea>
                        <textarea></textarea>
                        <textarea></textarea>
                    </div>
                <button id="add-item-btn">+ Lägg till nytt föremål</button>

                <div id="money-container" class="absolute bottom-[0] right-[0] bg-[red] w-[15vw]">
                    <?php 
                        $coin_types = array("Guld", "Silver", "Koppar" );

                        foreach ($coin_types as $coin_type) {
                            echo "<div class='$coin_type'>
                                <span class='max-w-[30%]'>$coin_type mynt: </span><textarea type='number' class='text-center bg-[aquamarine] border-[none] w-1/2'></textarea>
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