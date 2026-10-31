# MVP plaan: TaskHouse

## Probleem ja kasutaja

**Kasutaja:** üksikettevõtjast ehitaja, kes teeb klientidele ehitus- ja remonditöid ning kasutab vajadusel abiks teisi töömehi.

**Probleem:** ehitaja peab praegu objektide eelarvet, tööaega ja kulusid Excelis. See lahendus iseenesest töötab, kuid andmete sisestamine võtab aega ja iga objekti jaoks tuleb tabelit eraldi hallata. Eesmärk on muuta see mugavamaks. TaskHouse koondab objektid, tehtud tööd ja kulud ühte kohta ning arvutab automaatselt, kui palju eelarvest on kulunud ja kui palju alles. Kõik käimasolevad ja lõpetatud objektid on ühes kohas, nii et ehitaja saab lihtsalt vaadata ka varasemate objektide ajalugu: mis tööd tehti, kui palju aega kulus ja kui palju objekt tegelikult maksma läks.

Kuna projekt põhineb päris juhtumil, on mul võimalik uurida kasutaja tööprotsessi ja vajadusi ning küsida arenduse käigus tagasisidet.

## Vestluse põhjal selgunud nõuded

- Alustada tuleks **tegeliku töö ja kulude arvepidamisest**. Pakkumise detailne koostamine on samuti oluline, kuid selle võimaluse võib lisada hiljem. MVP-s piisab, kui objektile saab sisestada kogu maksumuse ehk eelarve (pakkumise summa või ehitaja enda hinnatud maksumus).
- Igal töömehel on **oma tunnihind**, mille järgi arvestatakse tehtud töö maksumust.
- Ehitaja ise on samuti üks töömees, kelle tunnid lähevad kirja.
- Tööd pannakse kirja **päeva, objekti ja töömehe kaupa** koos lühikese töökirjeldusega. Üksikuteks töölõikudeks jagamist ei ole vaja.
- Objekti kulud koosnevad kahest osast: **tööjõukulu** (töömeeste tunnid × tunnihind) ning **materjalid ja teenused** (nt transport, tööriistade rent), mis sisestatakse eraldi kuluridadena.
- MVP-s ei ole vaja eristada, kas summad on käibemaksuga või ilma.
- Andmeid sisestab ainult ehitaja ise, tavaliselt õhtul arvutis.
- Kliendile väljavõtet vaja ei ole.
- Andmete sisestamine peab olema kiire ja lihtne ning ülevaade objektidest ja nende ajaloost peab olema lihtsalt kättesaadav.

## Kuidas rakendust kasutatakse

1. **Avalehel** on nupp **"Lisa uus objekt"** ning nimekirjad **käimasolevatest** ja **lõpetatud** objektidest.
2. **Töömeeste lehel** lisab ehitaja töömehed (sh iseenda) koos tunnihinnaga.
3. Uue objekti puhul sisestab ta objekti nimetuse, tellija nime, vajadusel kirjelduse, kogu maksumuse ja alguse kuupäeva.
4. Töö käigus sisestab ta objekti juurde iga päeva **tehtud tööd** (kuupäev, töömees, tunnid, kirjeldus) ning **kulud** materjalidele ja teenustele (kuupäev, kulurida, summa).
5. **Objekti vaates** näeb ta kõiki selle objekti töid ja kulusid ning seda, kui palju eelarvest on kulunud ja kui palju alles.
6. Kui töö on valmis, märgib ta objekti **lõpetatuks**: lõpetamise kuupäev salvestub automaatselt ja objekt liigub avalehel lõpetatud objektide alla.
7. *(Kui aega jääb)* Objekti juures on **planeeritud tööde nimekiri**, kus saab iga töö juures märkida, kas see on tehtud (jah / ei / pooleli).

## Andmed ja arvutused

### Andmed

| Tabel | Väljad |
|---|---|
| `workers` (töömehed) | nimi, tunnihind (€) |
| `projects` (objektid) | nimetus, tellija nimi, kirjeldus (valikuline), kogu maksumus ehk eelarve (€), alguse kuupäev (valikuline), lõpetamise kuupäev (täidetakse automaatselt lõpetatuks märkimisel), staatus (käimas / lõpetatud) |
| `work_entries` (tehtud tööd) | kuupäev, objekt, töömees, tunnid, töökirjeldus, töömehe tunnihind (salvestatakse kirje tegemisel) |
| `expenses` (kulud) | kuupäev, objekt, kulurida (kirjeldus), summa (€) |
| `planned_tasks` (planeeritud tööd, kui aega jääb) | objekt, töö nimetus, tehtud (jah / ei / pooleli) |

### Arvutused

- **Töö maksumus** = tunnid × töömehe tunnihind
- **Kulunud kokku** = tööde maksumus kokku + kulud kokku
- **Eelarve jääk** = eelarve − kulunud kokku
- **Eelarvest kasutatud (%)** = kulunud kokku / eelarve × 100
- **Töömehe kokkuvõte objektil** = töömehe tunnid kokku sellel objektil ja nende maksumus kokku (töömehele tasu arvestamiseks)

Tehtud töö kirje salvestab töömehe tunnihinna kirje tegemise hetkel, et hilisem tunnihinna muutmine ei muudaks juba tehtud tööde maksumust.

## MVP funktsioonid

### MVP-s kindlasti olemas

- Avaleht: "Lisa uus objekt", käimasolevad objektid ja lõpetatud objektid
- Töömeeste leht: töömeeste lisamine ja muutmine koos tunnihinnaga (sh ehitaja ise)
- Objektide lisamine, muutmine, kustutamine ja lõpetatuks märkimine
- Tehtud tööde lisamine, muutmine ja kustutamine (töö maksumus arvutatakse töömehe tunnihinna järgi)
- Kulude lisamine, muutmine ja kustutamine (materjalid ja teenused)
- Objekti vaade: tehtud tööde ja kulude nimekiri ning eelarve kokkuvõte (kulunud, jääk, %)
- Objekti vaates töömeeste kaupa kokkuvõte: iga töömehe tunnid ja töö maksumus sellel objektil (tasu arvestamiseks)
- Kiire sisestamine: vormis on vaikimisi tänane kuupäev ja ehitaja ise töömehena

### MVP-s, kui aega jääb

- Objekti planeeritud tööde nimekiri koos märkega tehtud (jah / ei / pooleli)

### Tuleb hiljem

- Pakkumise koostamine: tööetapid, ajahinnangud, eelarve töölõikude kaupa ja materjalide nimekiri
- Käibemaksuga ja käibemaksuta summade eristamine
- Kliendi tunnihind ja kliendile arvestatava summa arvutamine
- Suurema objekti jagamine töögruppideks
- Kokkuvõtted perioodi kaupa (nt kuu tööd ja kulud kõigil objektidel)
- Mobiilivaate parem kohandamine ja PWA
- Sisselogimine (vajalik, kui rakendus pannakse internetti)

### Miks just need MVP-sse

Ehitaja põhivajadus on näha, kui palju objekti eelarvest on kulunud. Selleks on vaja objekti koos eelarvega, töömehi koos tunnihindadega, tehtud töid ja kulusid. Need koos objekti kokkuvõttega lahendavad põhiprobleemi ära ja asendavad Exceli arvepidamise osa, seega on see väikseim versioon, mida ehitaja saaks päriselt kasutada. Käimasolevate ja lõpetatud objektide eristamine hoiab avalehe selgena, kui objekte koguneb.

Planeeritud tööde nimekiri on kasulik, kuid põhiprobleemi lahendamiseks mitte hädavajalik, seetõttu teen selle MVP lõpus, kui aega jääb. Pakkumise detailne koostamine ja eelarve töölõikude kaupa jäid hilisemaks, sest ehitaja soovib alustada tegelikust arvepidamisest ning MVP-s piisab eelarve kogusummast. Need on olulised järgmised sammud pärast MVP-d. Käibemaksu eristamine jäi välja, et hoida arvutused lihtsana. Kuna ehitaja sisestab andmeid peamiselt õhtul arvutis, on MVP-s esmatähtis arvutivaade. Kuna teen projekti üksinda, on MVP teadlikult väike, et see saaks kindlasti valmis.

## Kasutajalood ja hinnangud

Hinnangud on story pointides (1 = väga lihtne, 2 = lihtne, 3 = keskmine, 5 = suur).

| # | Kasutajalugu | SP |
|---|---|---|
| 1 | Ehitajana tahan lisada töömehi (sh iseennast) koos tunnihinnaga ja tunnihinda vajadusel muuta, et tehtud töö maksumus arvutataks õigesti. | 2 |
| 2 | Ehitajana tahan lisada objekti koos nimetuse, tellija nime, kirjelduse, kogu maksumuse ja alguse kuupäevaga, et saaksin selle kulusid jälgida. | 3 |
| 3 | Ehitajana tahan näha avalehel käimasolevaid ja lõpetatud objekte eraldi, et leida kiiresti vajalik objekt. | 2 |
| 4 | Ehitajana tahan objekti andmeid muuta, objekti kustutada ja märkida objekti lõpetatuks (lõpetamise kuupäev salvestub automaatselt), et andmed oleksid õiged ja hiljem oleks näha, millal objekt valmis sai. | 2 |
| 5 | Ehitajana tahan lisada tehtud töö (kuupäev, töömees, tunnid, töökirjeldus), et töö maksumus arvutataks töömehe tunnihinna järgi. | 3 |
| 6 | Ehitajana tahan tehtud tööde kirjeid muuta ja kustutada, et parandada vigu. | 2 |
| 7 | Ehitajana tahan lisada kulu materjalidele või teenustele (kuupäev, kulurida, summa), et kõik kulud oleksid kirjas. | 3 |
| 8 | Ehitajana tahan kulusid muuta ja kustutada, et parandada vigu. | 2 |
| 9 | Ehitajana tahan näha objekti vaates selle tehtud töid ja kulusid, et saada ülevaade tehtust. | 2 |
| 10 | Ehitajana tahan näha objekti eelarve kokkuvõtet (kulunud, jääk, %), et teada, kas objekt püsib eelarves. | 3 |
| 11 | Ehitajana tahan näha objekti vaates iga töömehe tunde ja töö maksumust sellel objektil, et saaksin arvestada töömeeste tasud. | 2 |
| | **Kokku** | **26** |

**Kui aega jääb:**

| # | Kasutajalugu | SP |
|---|---|---|
| 12 | Ehitajana tahan lisada objekti juurde planeeritud tööde nimekirja, et teaksin, mis on veel teha. | 3 |
| 13 | Ehitajana tahan märkida planeeritud töö juurde, kas see on tehtud (jah / ei / pooleli), et näha, kui kaugel objektiga olen. | 1 |

### Tehnilised ülesanded

| Ülesanne | SP |
|---|---|
| Laraveli projekti loomine ja GitHubiga sidumine | 2 |
| Jira ja GitHubi ühendamine | 1 |
| Kasutajaliidese visandid (avaleht, objekti vaade, töömeeste leht) | 2 |
| Andmemudel ja migratsioonid (workers, projects, work_entries, expenses) | 3 |
| Rakenduse põhivaade (layout) ja menüü (Tailwind CSS) | 2 |

### Aktsepteerimiskriteeriumide näide

**Lugu 5, tehtud töö lisamine:**
- vorm avaneb objekti vaatest ja objekt on juba valitud;
- vormis on kuupäev (vaikimisi täna), töömees (vaikimisi ehitaja ise), tunnid ja töökirjeldus;
- tundide väli lubab ainult positiivset arvu;
- ilma tundideta ei saa salvestada;
- töö maksumus arvutatakse automaatselt (tunnid × töömehe tunnihind) ja kirjega salvestatakse töömehe tollane tunnihind;
- pärast salvestamist ilmub kirje objekti vaatesse ja eelarve jääk uueneb.

## Metoodika

Valisin Kanbani, kuna teen projekti üksinda (tiimikaaslasi ei õnnestunud leida). Scrum eeldab mitmeliikmelist tiimi, kindlaid rolle ja tiimi koosolekuid, mis ühe inimese projektis muutuksid kunstlikuks.

Kanbani valiku põhjendused:

- see ei nõua kindlaid rolle ega fikseeritud pikkusega sprinte;
- board teeb töövoo nähtavaks, nii et näen alati, mis on tegemata, mis pooleli ja mis valmis;
- WIP-limiit 2 aitab keskenduda ja asju lõpetada: üks ülesanne on töös ja teine varuks;
- nõuded täpsustuvad projekti käigus ja Kanbanis saan backlogi jooksvalt muuta;
- see arvestab ka seda, et projektile kasutatav aeg on nädalate lõikes kõikuv.

Iga kahe nädala järel teen projekti standupi ja retrospektiivi: vaatan, kus olen, mis läks hästi ja mis mitte, panen kirja, mida muudan, ning planeerin järgmised ülesanded.

## Kes mida teeb

| Liige | Vastutusalad | Roll |
|---|---|---|
| Christina | Nõuded ja planeerimine, andmebaas, backend, frontend, disain, testimine | Product owner (otsustan prioriteedid ja backlogi järjekorra), jälgin töövoogu ja teen retrospektiivid |
| Ehitaja | Annab infot oma tööprotsessi kohta ja tagasisidet valminud osadele | Kasutaja ja sidusrühm (ei ole ametlik tellija) |

See on esialgne jaotus ja võib projekti käigus muutuda.

## Esimene voog

Kanbanis ei ole sprinte, vaid pidev töövoog. Board'i veerud on **To Do → In Progress → Done** ning WIP-limiit on **2**.

Pärast MVP plaani valmimist võtan esimesena tööle:

1. Laraveli projekti loomine ja GitHubiga sidumine
2. Kasutajaliidese visandid
3. Andmemudel ja migratsioonid
4. Rakenduse põhivaade ja menüü
5. Lugu 1: töömeeste lisamine
6. Lugu 2: objekti lisamine
7. Lugu 3: avaleht käimasolevate ja lõpetatud objektidega
8. Lugu 5: tehtud töö lisamine

Kõik ülesanded teen ise. Järgmise standupi ja retrospektiivi ajal panen kirja, mis läks hästi, mis mitte ja mida muudan.

## Valmis-definitsioon

Lugu on valmis, kui:

- kood on GitHubi repos (main harus) ja commit'i sõnum sisaldab Jira kaardi võtit (nt `TH-25`);
- funktsioon töötab brauseris ja olen seda ise käsitsi testinud;
- loo aktsepteerimiskriteeriumid on täidetud;
- arvutused on kontrollitud vähemalt ühe käsitsi arvutatud näitega;
- ülesanne on Jira board'il liigutatud veergu **Done**.

## Muudatuste ajalugu

Planeerimise etapp:

- **16.10.2026:** alustasin ideede kogumist. Esialgne idee oli pere ülesannete planeerija.
- **17.10.2026:** muutsin projekti ideed. Teen rakenduse üksikettevõtjast ehitajale, kes peab praegu eelarvet, tööaega ja kulusid Excelis. Põhjus: päris kasutaja ja päris probleem, saan temaga vesteldes teada tema vajadused ja küsida tagasisidet.
- **29.10.2026:** vestluse põhjal ehitajaga selgusid peamised nõuded: alustada tegeliku töö ja kulude arvepidamisest, pakkumise koostamine tuleb hiljem; igal töömehel on oma tunnihind; eelarvet võrreldakse tegelike kuludega; esmatähtis on arvutivaade, kuna andmeid sisestatakse peamiselt arvutis.
- **30.–31.10.2026:** täpsustasin rakenduse kasutamise loogikat ja koostasin MVP plaani. Avalehel on uue objekti lisamine ning käimasolevad ja lõpetatud objektid. Objektil on tellija nimi ning alguse ja lõpetamise kuupäev, et objektide ajalugu oleks lihtne vaadata. Töömeestel on oma leht tunnihindade haldamiseks ja objekti vaates on töömeeste kaupa kokkuvõte tasude arvestamiseks. Planeeritud tööde nimekiri on MVP-s valikuline ("kui aega jääb"). Käibemaksu eristamine ja kululiigid jäid MVP-st välja, et hoida rakendus ja sisestamine lihtsana.

Edaspidi lisan siia read, kui MVP plaan arenduse käigus muutub.