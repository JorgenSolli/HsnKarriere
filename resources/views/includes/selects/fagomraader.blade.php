@if ($brukerinfo->bruker_type == "bedrift")
    <optgroup label="Dine valg">
      @foreach ($company as $fagfelt)
        <option selected value="{{ $fagfelt['area_of_expertise'] }}">{{ $fagfelt['area_of_expertise'] }} </option>
      @endforeach
    </optgroup>
@endif

<optgroup label="Admin./økonomi, kontor og jus">
  <option value="Bank, finans og forsikring">
      Bank, finans og forsikring
  </option>
  <option value="Juridisk arbeid">
      Juridisk arbeid
  </option>
  <option value="Kontor, forvaltning og saksbehandling">
      Kontor, forvaltning og saksbehandling
  </option>
  <option value="Ledelse, administrasjon og rådgivning">
      Ledelse, administrasjon og rådgivning
  </option>
  <option value="Logistikk, lagerarbeid og innkjøp">
      Logistikk, lagerarbeid og innkjøp
  </option>
  <option value="Markedsføring og reklame">
      Markedsføring og reklame
  </option>
  <option value="Økonomi, statistikk og regnskap">
      Økonomi, statistikk og regnskap
  </option>
  <option value="Megling og agentur">
      Megling og agentur
  </option>
  <option value="Organisasjonsarbeid og politikk">
      Organisasjonsarbeid og politikk
  </option>
  <option value="Personal, arbeidsmiljø og rekruttering">
      Personal, arbeidsmiljø og rekruttering
  </option>
</optgroup>
<optgroup label="Handel, kundeservice, restaurant og reiseliv">
  <option value="Kundeservice og personlig tjenesteyting">
      Kundeservice og personlig tjenesteyting
  </option>
  <option value="Markedsføring og reklame">
      Markedsføring og reklame
  </option>
  <option value="Megling og agentur">
      Megling og agentur
  </option>
  <option value="Reiseliv, hotell og overnatting">
      Reiseliv, hotell og overnatting
  </option>
  <option value="Restaurant og forpleining">
      Restaurant og forpleining
  </option>
  <option value="Salg, butikk- og varehandel">
      Salg, butikk- og varehandel
  </option>
</optgroup>
<optgroup label="Helse, omsorg, medisin og biologi">
  <option value="Biologi og bioteknologi">
      Biologi og bioteknologi
  </option>
  <option value="Farmasøytisk og apotekerarbeid">
      Farmasøytisk og apotekerarbeid
  </option>
  <option value="Helse- og pleiearbeid">
      Helse- og pleiearbeid
  </option>
  <option value="Leger, psykologer og terapeuter">
      Leger, psykologer og terapeuter
  </option>
  <option value="Sosial-, omsorgs- og fritidsarbeid">
      Sosial-, omsorgs- og fritidsarbeid
  </option>
  <option value="Tannhelse/-pleie">
      Tannhelse/-pleie
  </option>
  <option value="Veterinærer og dyrepleiere">
      Veterinærer og dyrepleiere
  </option>
</optgroup>
<optgroup label="Industri, bygg/anlegg, håndverk og verkstedsarbeid">
  <option value="Arealplanlegging og arkitektur">
      Arealplanlegging og arkitektur
  </option>
  <option value="Bygg og anlegg">
      Bygg og anlegg
  </option>
  <option value="Elektro/elektronikk">
      Elektro/elektronikk
  </option>
  <option value="Fysikk, kjemi og metallurgi">
      Fysikk, kjemi og metallurgi
  </option>
  <option value="Jern og metall">
      Jern og metall
  </option>
  <option value="Maling og overflatebehandling">
      Maling og overflatebehandling
  </option>
  <option value="Maskin-, kran- og truckførere o.l">
      Maskin-, kran- og truckførere o.l
  </option>
  <option value="Maskinteknikk og mekanikk">
      Maskinteknikk og mekanikk
  </option>
  <option value="Olje, gass og bergverk">
      Olje, gass og bergverk
  </option>
  <option value="Tekstil, kunsthåndverk og presisjonsarbeide">
      Tekstil, kunsthåndverk og presisjonsarbeide
  </option>
  <option value="Trevarearbeid og -foredling">
      Trevarearbeid og -foredling
  </option>
</optgroup>
<optgroup label="Jord-/skogbruk, fiske og matproduksjon">
  <option value="Fiske, fangst og oppdrett">
      Fiske, fangst og oppdrett
  </option>
  <option value="Jordbruk og dyrehold">
      Jordbruk og dyrehold
  </option>
  <option value="Matproduksjon og næringsmiddelarbeid">
      Matproduksjon og næringsmiddelarbeid
  </option>
  <option value="Skogbruk, gartnerarbeide og hagebruk">
      Skogbruk, gartnerarbeide og hagebruk
  </option>
</optgroup>
<optgroup label="Kultur, religiøst arbeid, idrett og informasjonsformidling">
  <option value="Grafisk arbeid, design og dekorasjon">
      Grafisk arbeid, design og dekorasjon
  </option>
  <option value="Journalistikk og media">
      Journalistikk og media
  </option>
  <option value="Litteratur, kunst og illustrasjon">
      Litteratur, kunst og illustrasjon
  </option>
  <option value="Museum, bibliotek og arkiv">
      Museum, bibliotek og arkiv
  </option>
  <option value="Musikk/lyd, foto og video">
      Musikk/lyd, foto og video
  </option>
  <option value="Religiøst arbeid">
      Religiøst arbeid
  </option>
  <option value="Sport og idrett">
      Sport og idrett
  </option>
  <option value="Tolk og oversetter">
      Tolk og oversetter
  </option>
  <option value="Underholdning, scene og teater">
      Underholdning, scene og teater
  </option>
</optgroup>
<optgroup label="Service- og sikkerhetsarbeid">
  <option value="Brann-, utryknings- og redningspersonell">
      Brann-, utryknings- og redningspersonell
  </option>
  <option value="Forsvar/militær">
      Forsvar/militær
  </option>
  <option value="Kundeservice og personlig tjenesteyting">
      Kundeservice og personlig tjenesteyting
  </option>
  <option value="Miljøvern">
      Miljøvern
  </option>
  <option value="Politi, fengsel og toll">
      Politi, fengsel og toll
  </option>
  <option value="Vakt-, sikrings- og kontrollarbeid">
      Vakt-, sikrings- og kontrollarbeid
  </option>
  <option value="Vaktmestere, renhold og renovasjon">
      Vaktmestere, renhold og renovasjon
  </option>
</optgroup>
<optgroup label="Skole, fritid, undervisning og forskning">
  <option value="Barnehage, og grunnskole">
      Barnehage, og grunnskole
  </option>
  <option value="Forskningsarbeid">
      Forskningsarbeid
  </option>
  <option value="Fritid">
      Fritid
  </option>
  <option value="Instruktører og pedagoger">
      Instruktører og pedagoger
  </option>
  <option value="Universitet og høgskole">
      Universitet og høgskole
  </option>
  <option value="Videregående skole">
      Videregående skole
  </option>
</optgroup>
<optgroup label="Transport, logistikk, kommunikasjon og IT">
  <option value="Informasjons- og kommunikasjonsteknologi">
      Informasjons- og kommunikasjonsteknologi
  </option>
  <option value="Logistikk, lagerarbeid og innkjøp">
      Logistikk, lagerarbeid og innkjøp
  </option>
  <option value="Lufttrafikk">
      Lufttrafikk
  </option>
  <option value="Maskin-, kran- og truckførere o.l">
      Maskin-, kran- og truckførere o.l
  </option>
  <option value="Sjøfart">
      Sjøfart
  </option>
  <option value="Tog- og sporvogntrafikk">
      Tog- og sporvogntrafikk
  </option>
  <option value="Vegtrafikk">
      Vegtrafikk
  </option>
</optgroup> 