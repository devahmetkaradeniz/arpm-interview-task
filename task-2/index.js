/** 
Modify a JavaScript function to animate the phrase "Hello World" character by character, moving each from div1 to div2 on a webpage. For this challenge, odd-indexed characters (considering the first character as index 0) should move with a delay calculated by 4 + index seconds. Even-indexed characters should only move one second after all adjacent odd-indexed characters have moved.
*/

var button = document.getElementById("myButton");

button.addEventListener("click", function () {
    alert("Button clicked!");
    /**
     *You code goes here
     */

    const textEl = document.querySelector("div#div1")
    const moveEl = document.querySelector('div#div2')

    const characters = textEl.textContent.split('')

    const oddDelay = 4
    const evenDelay = 1

    const moveCharacters = []

    characters.forEach((character, index) => {
        const delay = index % 2 === 0 ? evenDelay : oddDelay + index

        setTimeout(() => {
            moveCharacters[index] = character
            textEl.textContent = textEl.textContent.replace(character, '')
            moveEl.textContent = moveCharacters.join('')
        }, delay * 1000)
    })
});