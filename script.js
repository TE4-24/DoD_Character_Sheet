var abilityButton = document.getElementById('add-ability');
var abilities = document.getElementById('abilities');

var miscItemButton = document.getElementById('misc-item-btn');
var miscItems = document.getElementById('misc-item-text-container');

var weaponData = {
    "dolk": ["1H", "2", "1D", "3", "ful som fan"],
    "stenklubba": ["2H", "5", "7D", "15", "stor :-)"]
};

function updateWeaponData(input, rowIndex) {
    const weapon = input.value;
    const data = weaponData[weapon];
    if (data) {
        document.getElementById(`grip-${rowIndex}`).value = data[0];
        document.getElementById(`reach-${rowIndex}`).value = data[1];
        document.getElementById(`damage-${rowIndex}`).value = data[2];
        document.getElementById(`breakValue-${rowIndex}`).value = data[3];
        document.getElementById(`properties-${rowIndex}`).value = data[4];
    } else {
        document.getElementById(`grip-${rowIndex}`).value = "";
        document.getElementById(`reach-${rowIndex}`).value = "";
        document.getElementById(`damage-${rowIndex}`).value = "";
        document.getElementById(`breakValue-${rowIndex}`).value = "";
        document.getElementById(`properties-${rowIndex}`).value = "";
    }
}

abilityButton.addEventListener('click', function() {
    abilities.insertAdjacentHTML('beforeend', '<textarea></textarea> ');
    writeTableData();
});

miscItemButton.addEventListener('click', function() {
    miscItems.insertAdjacentHTML('beforeend', '<textarea></textarea> ')
});