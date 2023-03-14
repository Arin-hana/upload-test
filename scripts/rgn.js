//random name generator
function randomFunc(rgn) {
    //document.getElementById(rgn)
    for (let i = 0; i < 2; i++) {
        const random = rgn[Math.floor(Math.random() * rgn.length)];
        return random
        }
    }
const rgn = ["A", "B", "C", "D", "E", "F", "G", "H", "I", "J", "K", "L", "M", "N", "O", "P", "Q", "R", "S", "T", "U", "V", "X", "Y", "Z", "a", "b", "c", "d", "f", "g", "h", "i", "j", "k", "l", "m", "o", "p", "q", "r", "s", "t", "u", "v", "w", "x", "y", "z", "_", "-" ]


text = randomFunc(rgn)+randomFunc(rgn)+randomFunc(rgn)+randomFunc(rgn)+randomFunc(rgn)+randomFunc(rgn)+randomFunc(rgn)+randomFunc(rgn)+randomFunc(rgn)+randomFunc(rgn)+randomFunc(rgn);

document.getElementById("test").innerHTML = text;
console.log(text);
