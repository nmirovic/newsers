# Newsers
1. Uvod

   Projekat "Online novine" je web aplikacija koja služi kao portal elektronskih novina, omogućavajući korisnicima čitanje, pretragu i interakciju sa vestima. Aplikacija je izrađena koristeći PHP programski jezik za backend logiku, MySQL bazu podataka za skladištenje informacija, HTML, CSS i JavaScript za frontend korisnički interfejs. Za stilizovanje i brži razvoj korisničkog interfejsa korišćen je Bootstrap, popularni CSS framework koji omogućava brzo i jednostavno kreiranje responzivnih web stranica. Zalokalni razvoj korišćen je WAMP server, dok je Visual Studio Code korišćen kao glavni alat za uređivanje koda. Iako je većina funkcionalnosti implementirana korišćenjem PHP-a, Bootstrap i JavaScript su korišćeni za dodatnu funkcionalnost i poboljšanje korisničkog iskustva.

2. Funkcionalni zahtevi

   2.1 Pregled vesti
   Korisnici mogu pregledati vesti na portalu, prikazujući se aktuelne vesti na početnoj stranici, sa mogućnošću pretrage i pristupa arhivi vesti.
   
   2.2 Struktura vesti
   Vesti su definisane naslovom, tekstom koji može sadržati slike, video linkove i formatiranje (npr. podebljan i kurziv tekst, naslovi podnaslovi), kao i tagovima radi lakšeg indeksiranja i pretrage. Svaka vest pripada određenoj rubrici (političke, crna hronika, sport, zabava, kultura, itd.).
   
   2.3 Pretraga vesti
   Korisnici mogu pretraživati vesti po naslovu, tagovima i/ili datumu.
   
   2.4 Interakcija korisnika
   Korisnici mogu lajkovati ili dislajkovati vesti, kao i ostavljati komentare. Za ove akcije nije potrebna prijava, korisnik može uneti jednokratno korisničko ime pri unošenju komentara. Komentare je takođe moguće lajkovati i dislajkovati, uz prikaz broja lajkova i dislajkova.
   
   2.5 Administracija vesti
   Novinari mogu kreirati nove vesti unutar određene rubrike, čuvajući ih u draft stanju kao radnu verziju. Kada vest bude završena, novinar je šalje uredniku na pregledanje. Nakon odobrenja urednika, vest postaje vidljiva na sajtu. Svaka promena vesti zahteva novo odobrenje. Urednici mogu odobravati i brisati vesti unutar svojih nadležnih rubrika.
   
   2.6 Sistem privilegija
   Postoji razlika između novinara i urednika. Novinari mogu dodavati članke samo u svoje rubrike, dok urednici imaju dodatne privilegije nad više rubrika ili kao glavni urednici. Samo glavni urednik može registrovati nove novinare i dodeljivati im rubrike.


3. Instalacija i pokretanje

   3.1. Kloniranje repozitorijuma sa GitHub-a:

   Posetite GitHub repozitorijum koji želite da klonirate.
   Kliknite na dugme "Code" i kopirajte URL repozitorijuma.
   Otvorite terminal na svom računaru i navigirajte do direktorijuma u koji želite da klonirate repozitorijum.

   3.2. Podešavanje XAMP servera i MySQL baze podataka:

   Preuzmite XAMP server sa zvanične web stranice: https://apachefriends.org/download.html.
   Pratite uputstva za instalaciju XAMP servera na vašem računaru.
   Nakon instalacije, pokrenite XAMP server.

   3.3. Importovanje SQL dump-a u MySQL bazu podataka:

   Otvorite MySQL Workbench, koji možete preuzeti sa zvanične web stranice: https://www.mysql.com/products/workbench.
   Povežite se na lokalni MySQL server koji pokreće XAMP.
   Kreirajte novu bazu podataka pomoću fajla newsers.sql.
   Importujte SQL dump fajl koji ste prethodno preuzeli iz repozitorijuma.

   Klonirani repozitorijum će sadržati direktorijum sa svim potrebnim fajlovima i folderima.
   Kopirajte sadržaj ovog direktorijuma unutar XAMP servera.
   Pokretanje XAMP servera i pristup aplikaciji putem web pregledača:

   Otvorite web pregledač i unesite sledeću putanju: http://localhost/newsers/index.php

5. Autor
   
   Ime Prezime: Nikola Mirovic 632/2018
