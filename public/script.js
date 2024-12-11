

var saveButton = document.getElementById('save-btn');



var weaponData = {
    "dolk": ["1H", "2", "1D", "3", "ful som fan"],
    "stenklubba": ["2H", "5", "7D", "15", "stor :-)"]
};



saveButton.addEventListener('click', function () {
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    const characterInfo = getCharacterInfo(); 

    let postData = "";
    for (const [key, value] of Object.entries(characterInfo)) {
            postData += `&${encodeURIComponent(key)}=${encodeURIComponent(value)}`;
    }

    const xhttp = new XMLHttpRequest();
    xhttp.open("POST", "/DBconnection", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.setRequestHeader("X-CSRF-TOKEN", csrfToken);
    xhttp.onreadystatechange = function () {
        if (xhttp.readyState === 4) {
            if (xhttp.status === 200) {
                console.log(xhttp.responseText);
            } else {
                console.error("Request failed with status: " + xhttp.status);
            }
        }
    };
    xhttp.send(postData);
});

function getCharacterStats() {
    var stats = document.querySelectorAll('#stat-container > div');

    for(var i = 0; i < stats.length-1; i++) {
        var stat = stats[i].id.replace('stat ', '');
        var statValue = stats[i].getElementsByTagName('textarea')[0].value;
        console.log(stat, statValue);
    }
}

function getCharacterInfo() {
    var dataFields = document.querySelectorAll('#description-container > div');
    var characterInfo = {};

    for(var i = 0; i < dataFields.length-1; i++) {
        var nameAlias = dataFields[i].getElementsByTagName('textarea')[0];
        var descriptions = dataFields[i].getElementsByTagName('input')[0];
        var dataType = dataFields[i].getElementsByTagName('span')[0].innerHTML;

        if (nameAlias != null) {
            characterInfo[dataType] = nameAlias.value;
        }
        else if (descriptions != null) {
            characterInfo[dataType] = descriptions.value;
        }
    }

    var weaknessDesc = document.getElementById('weakness-desc');
    if (weaknessDesc) {
        characterInfo['weakness'] = weaknessDesc.innerHTML;
    }

    return characterInfo;
}


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


function addTextArea(elementID) {
    var element = document.getElementById(elementID);
    element.insertAdjacentHTML('beforeend', '<textarea></textarea> ');
}

var abilityButton = document.getElementById('add-ability');
abilityButton.addEventListener('click', function() {
    addTextArea('abilities');
});

var miscItemButton = document.getElementById('misc-item-btn');
miscItemButton.addEventListener('click', function() {
    addTextArea('misc-item-text-container');
});

var inventoryItemButton = document.getElementById('add-item-btn');
inventoryItemButton.addEventListener('click', function() {
    addTextArea('item-container');
});
