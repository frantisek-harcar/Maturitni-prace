# Maturitni-prace

# Založení účtu a přihlášení
K těmto funkcím se lze dostat přes tlačítko „login“ v pravém horním rohu navigace. Budete přesměrování na stránku registrace.
Po vyplnění uživatelského jména, které může obsahovat pouze znaky a-z, A-Z a 0-9, emailu, hesla a jeho ověření ve formuláři Signup je uživatel zaregistrován. Nyní se stačí pomocí formuláře Login přihlásit do systému. Do políčka pro jméno lze zadat uživatelské jméno, nebo email.
Odhlášení
Pomocí tlačítka Logout, které se po přihlášení zobrazí namísto Login.
Obchod
Do obchodu se lze dostat pomocí tlačítka v navigaci „Shop“. Na stránce obchodu se zobrazí nabízené položky, které si uživatel může přidat do košíku pomocí tlačítka na kartě. Každý produkt lze přidat jen jednou a množství se upravuje později v košíku.
 
Obrázek 1 – Stránka obchodu
Dále se na stránce nachází filtry zboží. V horní části jsou filtry, které umožní třídit zboží podle toho, které jsou nejprodávanější, nebo nejnovější. V levé části obchodu se nachází navigace, která umožňuje filtrovat podle typu produktu. 
Na každý produkt lze kliknout a zobrazit si jeho detail.
 
Obrázek 2 – Detail produktu
Košík
Tlačítko košíku se nachází v navigaci, vedle něj je číslo, které indikuje počet položek v košíku. Pokud je košík prázdný, na stránce se zobrazí pouze text, když se bude v košíku nacházet nějaká položka, zobrazí se tlačítka pro vyprázdnění košíku a pro objednávku.
 
Obrázek 3 – Košík s položkami
Je možné měnit množství položek pomocí tlačítek plus a mínus, lze také zadat hodnotu přímo do políčka s číslem, kterou je nutno potvrdit enterem.
Položku lze odstranit pomocí tlačítka na kartě, nebo vyprázdnit celý košík. 
Objednávka
Po kliknutí na tlačítko Objednat se uživatel dostane na stránku, kde se nachází shrnutí košíku a pro dokončení objednávky musí vyplnit kontaktní informace (email, mobil…) a adresu pro doručení balíčku.
Po potvrzení objednávky přijde na zadaný email potvrzení objednávky.
 
Obrázek 4 – Formulář objednávky

# Administrace
Pokud je přihlášený uživatel administrátor (nastavuje se v databázi 1, nebo 0) zobrazí se mu v navigaci tlačítko Administrace, které ho přesměruje na stejnojmennou stránku.
 
Obrázek 5 – Tlačítko administrace
Zde je zatím funkční pouze tlačítko pro administraci obchodu. Po kliknutí se uživatel dostane na administrátorskou verzi obchodu, která obsahuje tlačítko pro manipulaci s produkty, přidání nového produktu a pod filtry přibude tlačítko na navrácení do administrace. Filtry fungují i v administraci. 
Obrázek 6 – Stránka administrace obchodu

# Přidání produktu
Zelené tlačítko pro přidání položky zobrazí novou stránku s formulářem pro přidání nového produktu. Po vyplnění je položka přidána do databáze a vypsána v obchodě. Je nutné, aby se název souboru v políčku „cesta k obrázku“ opravdu shodoval s názvem souboru i koncovkou!
 
Obrázek 7 – Přidání položky
Je možné i nahrát obrázek na server, který by měl nejlépe být průhledný. Jsou povoleny soubory s koncovkou .jpg, .jpeg, .png a velikostí maximálně 1 Megabyte.
Pomocí tlačítka Zpět do obchodu je možno vrátit se zpět.
Úprava produktu
Žluté tlačítko zobrazí podobnou stránku jako zelené, ale hodnoty zde jsou už vyplněné podle toho, jaký produkt je upravován. Pro úpravu stačí jen změnit hodnotu v poli a potvrdit formulář.
 
Obrázek 8 – Úprava položky
# Odstranění produktu
Po zmáčknutí červeného tlačítka je produkt smazán z obchodu, košíku i databáze a není možné jej obnovit.
Další funkce webu
Na hlavní stránce je ještě možné zobrazit si stránku O nás, na které se nachází výpis lidí, kteří jsou spojeni se Sunable, jejich kontakt a odkaz na streamovací službu Spotify.  
Obrázek 9 – Stránka O nás
Dále je možné zobrazit základní verzi galerie tlačítkem Fotky. V galerii je možné filtrovat fotky podle kategorie, do které je každá fotka zařazena při vkládání do databáze.
 
Obrázek 10 – Galerie
Tlačítko Video Sungate odkáže na video z akce pořádané Sunablem.
Tlačítko Tvorba odkáže na streamovací službu Spotify.
