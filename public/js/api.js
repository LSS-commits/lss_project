/*---------- INSPIRATIONS QUOTES ----------*/

// utiliser Fetch API et l'API typeof.fit pour les citations
fetch("https://type.fit/api/quotes")
.then(function(response) {
    return response.json();
})
.then(function(data) {
    // choisir une citation de manière aléatoire
    let randomQuote = data[Math.floor(Math.random()*data.length)];
    
    document.getElementById("quote").innerHTML = randomQuote.text;
    let author = randomQuote.author.split(", ");
    author = author[0] == "type.fit" ? "Unknown author" : author[0];
    document.getElementById("author").innerHTML = author;
});

