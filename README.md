# Obsah
- [Instalace](#instalace)
  - [Localhost](#localhost)
  - [FTP](#ftp)
- [Uživatelská příručka](#uzivatelska-prirucka)
  - [Založení účtu a přihlášení](#zalozeni-uctu-a-prihlaseni)
  - [Odhlášení](#odhlaseni)
  - [Obchod](#obchod)
  - [Košík](#kosik)
  - [Objednávka](#objednavka)
  - [Administrace](#administrace)
  - [Přídání produktu](#pridani-produktu)
  - [Odstranění produktu](#odstraneni-produktu)
  - [Další funkce webu](#dalsi-funkce-webu)


# Instalace

## Localhost

Pokud byste chtěli aplikaci spustit lokálně na svém počítači (na localhostu), budete potřebovat program, který Vám poskytne MySQL databázi a Apache webový server, doporučuji XAMPP (zapněte MySQL a Apache).

Přiložený soubor sunable.sql, který obsahuje strukturu tabulek bez dat, importujte do své MySQL databáze.

Dále nahrajte přiložené soubory do složky htdocs programu XAMPP (nebo jiné složky, která plní stejný účel, pokud používáte jiný program), díky které můžete projekt zpřístupnit na stránce localhost.

Upravte soubor dblogin.php (nachází se ve složce includes), který obsahuje údaje k připojení do databáze.

Zadejte vlastní hodnoty pro proměnné:

 $servername = „localhost“,
 
 $dbusername = „root“ (nebo jméno účtu přistupujícího k databázi),
 
 $dbpwd = „“ (nebo heslo k uživatelskému účtu),
 
 $db = „název vaší databáze“.

Po těchto krocích by měla být aplikace funkční.

## FTP

Pokud chcete nahrát aplikaci na server, je potřeba mít na něm verzi PHP 7.x a musí podporovat MySQL databázi.

Importujte soubor sunable.sql do databáze, nahraje se struktura tabulek bez dat.

Nahrajte zdrojové soubory na svého FTP klienta.

Upravte soubor pro připojení k databázi dblogin.php (popsán výše).

Po těchto krocích by měla být aplikace funkční.

# Uživatelská příručka

## Založení účtu a přihlášení

K těmto funkcím se lze dostat přes tlačítko „login“ v pravém horním rohu navigace. Budete přesměrování na stránku registrace.

Po vyplnění uživatelského jména, které může obsahovat pouze znaky a-z, A-Z a 0-9, emailu, hesla a jeho ověření ve formuláři Signup je uživatel zaregistrován. Nyní se stačí pomocí formuláře Login přihlásit do systému. Do políčka pro jméno lze zadat uživatelské jméno, nebo email.

## Odhlášení

Pomocí tlačítka Logout, které se po přihlášení zobrazí namísto Login.

## Obchod

Do obchodu se lze dostat pomocí tlačítka v navigaci „Shop“. Na stránce obchodu se zobrazí nabízené položky, které si uživatel může přidat do košíku pomocí tlačítka na kartě. Každý produkt lze přidat jen jednou a množství se upravuje později v košíku.

![image](https://github.com/frantisek-harcar/Maturitni-prace/assets/56251309/28979c9a-140a-4245-9fd7-741227eb72e1)
 
*Obrázek 1 – Stránka obchodu*


Dále se na stránce nachází filtry zboží. V horní části jsou filtry, které umožní třídit zboží podle toho, které jsou nejprodávanější, nebo nejnovější. V levé části obchodu se nachází navigace, která umožňuje filtrovat podle typu produktu.

Na každý produkt lze kliknout a zobrazit si jeho detail.

![image](https://github.com/frantisek-harcar/Maturitni-prace/assets/56251309/1c5eff63-7958-40e2-8bb1-464a35e83fbf)
 
*Obrázek 2 – Detail produktu*


## Košík

Tlačítko košíku se nachází v navigaci, vedle něj je číslo, které indikuje počet položek v košíku. Pokud je košík prázdný, na stránce se zobrazí pouze text, když se bude v košíku nacházet nějaká položka, zobrazí se tlačítka pro vyprázdnění košíku a pro objednávku.

![image](https://github.com/frantisek-harcar/Maturitni-prace/assets/56251309/07d3de10-9cc6-48ec-83b3-4458b47260fe)

*Obrázek 3 – Košík s položkami*


Je možné měnit množství položek pomocí tlačítek plus a mínus, lze také zadat hodnotu přímo do políčka s číslem, kterou je nutno potvrdit enterem.

Položku lze odstranit pomocí tlačítka na kartě, nebo vyprázdnit celý košík. 

## Objednávka

Po kliknutí na tlačítko Objednat se uživatel dostane na stránku, kde se nachází shrnutí košíku a pro dokončení objednávky musí vyplnit kontaktní informace (email, mobil…) a adresu pro doručení balíčku.

Po potvrzení objednávky přijde na zadaný email potvrzení objednávky.

![image](https://github.com/frantisek-harcar/Maturitni-prace/assets/56251309/1fd01866-2a62-4272-8efb-6127624a8697)
 
*Obrázek 4 – Formulář objednávky*


## Administrace

Pokud je přihlášený uživatel administrátor (nastavuje se v databázi 1, nebo 0) zobrazí se mu v navigaci tlačítko Administrace, které ho přesměruje na stejnojmennou stránku.

![image](https://github.com/frantisek-harcar/Maturitni-prace/assets/56251309/a98f7f6d-ca5a-4898-9c92-0697c0177706)
 
*Obrázek 5 – Tlačítko administrace*


Zde je zatím funkční pouze tlačítko pro administraci obchodu. Po kliknutí se uživatel dostane na administrátorskou verzi obchodu, která obsahuje tlačítko pro manipulaci s produkty, přidání nového produktu a pod filtry přibude tlačítko na navrácení do administrace. Filtry fungují i v administraci. 

![image](https://github.com/frantisek-harcar/Maturitni-prace/assets/56251309/4bcbb6fe-3b14-4fae-86d6-455530e382e1)

*Obrázek 6 – Stránka administrace obchodu*

## Přidání produktu

Zelené tlačítko pro přidání položky zobrazí novou stránku s formulářem pro přidání nového produktu. Po vyplnění je položka přidána do databáze a vypsána v obchodě. Je nutné, aby se název souboru v políčku „cesta k obrázku“ opravdu shodoval s názvem souboru i koncovkou!

![image](https://github.com/frantisek-harcar/Maturitni-prace/assets/56251309/af77fa3f-f66b-4275-9349-7f35faf148ef)

*Obrázek 7 – Přidání položky*


Je možné i nahrát obrázek na server, který by měl nejlépe být průhledný. Jsou povoleny soubory s koncovkou .jpg, .jpeg, .png a velikostí maximálně 1 Megabyte.
Pomocí tlačítka Zpět do obchodu je možno vrátit se zpět.

## Úprava produktu

Žluté tlačítko zobrazí podobnou stránku jako zelené, ale hodnoty zde jsou už vyplněné podle toho, jaký produkt je upravován. Pro úpravu stačí jen změnit hodnotu v poli a potvrdit formulář.

![image](https://github.com/frantisek-harcar/Maturitni-prace/assets/56251309/a76285b6-228f-4eae-b0c5-e29c6357ec28)
 
*Obrázek 8 – Úprava položky*


## Odstranění produktu

Po zmáčknutí červeného tlačítka je produkt smazán z obchodu, košíku i databáze a není možné jej obnovit.

## Další funkce webu

Na hlavní stránce je ještě možné zobrazit si stránku O nás, na které se nachází výpis lidí, kteří jsou spojeni se Sunable, jejich kontakt a odkaz na streamovací službu Spotify.  

![image](https://github.com/frantisek-harcar/Maturitni-prace/assets/56251309/8e302283-e579-4b4a-9246-623172e1ead0)

*Obrázek 9 – Stránka O nás*


Dále je možné zobrazit základní verzi galerie tlačítkem Fotky. V galerii je možné filtrovat fotky podle kategorie, do které je každá fotka zařazena při vkládání do databáze.

![image](https://github.com/frantisek-harcar/Maturitni-prace/assets/56251309/0e4ffcfd-688f-4488-aa81-8e9bfcb22bb6)
 
*Obrázek 10 – Galerie*

