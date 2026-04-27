let sviFilmovi = [];
let kosarica = [];

fetch('movies.csv')
    .then(response => response.text())
    .then(csv => {
        const rezultat = Papa.parse(csv, {
            header: true,
            skipEmptyLines: true
        });

        sviFilmovi = rezultat.data.map(film => ({
            naslov: film.Naslov,
            zanr: film.Zanr,
            godina: Number(film.Godina),
            trajanje: Number(film.Trajanje_min),
            ocjena: Number(film.Ocjena),
            reziser: film.Rezisery,
            drzava: film.Zemlja_porijekla
        }));

        prikaziTablicu(sviFilmovi);
    })
    .catch(error => {
        console.error('Greška pri dohvaćanju CSV datoteke:', error);
    });

function prikaziTablicu(filmovi) {
    const tbody = document.querySelector('#filmovi-tablica tbody');
    tbody.innerHTML = '';

    if (filmovi.length === 0) {
        tbody.innerHTML = `
            <tr>
                <td colspan="7">Nema filmova za odabrane filtere.</td>
            </tr>
        `;
        return;
    }

    filmovi.forEach(film => {
        const row = document.createElement('tr');

        row.innerHTML = `
            <td>${film.naslov}</td>
            <td>${film.godina}</td>
            <td>${film.zanr}</td>
            <td>${film.trajanje} min</td>
            <td>${film.drzava}</td>
            <td>${film.ocjena}</td>
            <td>
                <button onclick="dodajUKosaricu('${film.naslov}')">
                    Dodaj
                </button>
            </td>
        `;

        tbody.appendChild(row);
    });
}

function dodajUKosaricu(naslovFilma) {
    const film = sviFilmovi.find(f => f.naslov === naslovFilma);

    const vecPostoji = kosarica.some(f => f.naslov === naslovFilma);

    if (vecPostoji) {
        document.getElementById('poruka-kosarice').textContent = 'Film je već u košarici.';
        return;
    }

    kosarica.push(film);
    osvjeziKosaricu();

    document.getElementById('poruka-kosarice').textContent = 'Film je dodan u košaricu.';
}

function osvjeziKosaricu() {
    const lista = document.getElementById('lista-kosarice');
    const brojFilmova = document.getElementById('broj-filmova');

    lista.innerHTML = '';
    brojFilmova.textContent = `Broj filmova: ${kosarica.length}`;

    kosarica.forEach((film, index) => {
        const li = document.createElement('li');

        li.innerHTML = `
            ${film.naslov} (${film.godina})
            <button onclick="ukloniIzKosarice(${index})">Ukloni</button>
        `;

        lista.appendChild(li);
    });
}

function ukloniIzKosarice(index) {
    kosarica.splice(index, 1);
    osvjeziKosaricu();

    document.getElementById('poruka-kosarice').textContent = 'Film je uklonjen iz košarice.';
}

function filtrirajFilmove() {
    const odabraniZanr = document.getElementById('filter-zanr').value.toLowerCase();
    const unesenaDrzava = document.getElementById('filter-drzava').value.toLowerCase();
    const minimalnaOcjena = Number(document.getElementById('filter-ocjena').value);

    const filtriraniFilmovi = sviFilmovi.filter(film => {
        const zanrOdgovara =
            odabraniZanr === '' ||
            film.zanr.toLowerCase().includes(odabraniZanr);

        const drzavaOdgovara =
            unesenaDrzava === '' ||
            film.drzava.toLowerCase().includes(unesenaDrzava);

        const ocjenaOdgovara = film.ocjena >= minimalnaOcjena;

        return zanrOdgovara && drzavaOdgovara && ocjenaOdgovara;
    });

    prikaziTablicu(filtriraniFilmovi);
}

document.getElementById('filter-ocjena').addEventListener('input', function () {
    document.getElementById('ocjena-vrijednost').textContent = this.value;
});

document.getElementById('primijeni-filtere').addEventListener('click', filtrirajFilmove);

document.getElementById('reset-filtera').addEventListener('click', function () {
    document.getElementById('filter-zanr').value = '';
    document.getElementById('filter-drzava').value = '';
    document.getElementById('filter-ocjena').value = 0;
    document.getElementById('ocjena-vrijednost').textContent = '0';

    prikaziTablicu(sviFilmovi);
});

document.getElementById('potvrdi-kosaricu').addEventListener('click', function () {
    if (kosarica.length === 0) {
        document.getElementById('poruka-kosarice').textContent = 'Košarica je prazna.';
        return;
    }

    document.getElementById('poruka-kosarice').textContent =
        `Uspješno ste dodali ${kosarica.length} filma u svoju košaricu za vikend maraton!`;

    kosarica = [];
    osvjeziKosaricu();
});