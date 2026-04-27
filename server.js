const express = require('express');
const path = require('path');

const app = express();
const PORT = process.env.PORT || 3000;

// koristi public mapu za HTML i CSS
app.use(express.static(path.join(__dirname, 'public')));

// postavljanje EJS (koristit ćemo kasnije)
app.set('view engine', 'ejs');
app.set('views', path.join(__dirname, 'views'));

// početna stranica
app.get('/', (req, res) => {
  res.sendFile(path.join(__dirname, 'public', 'index.html'));
});

// grafikon stranica
app.get('/grafikon', (req, res) => {
  res.sendFile(path.join(__dirname, 'public', 'grafikon.html'));
});

app.listen(PORT, () => {
  console.log(`Server radi na http://localhost:${PORT}`);
});

// galerija stranica (EJS)
app.get('/slike', (req, res) => {
  res.render('slike');
});