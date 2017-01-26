@if ($brukerinfo->bruker_type == "bedrift")
    <optgroup label="Dine valg">
      @foreach ($company as $fagfelt)
        <option selected value="{{ $fagfelt['area_of_expertise'] }}">{{ $fagfelt['area_of_expertise'] }} </option>
      @endforeach
    </optgroup>
@endif

<optgroup label="Institutt for Økonomi og Informatikk">
    <option value="Geografiske Informasjonssystemer">Geografiske Informasjonssystemer</option>
    <option value="Regnskap og Revisjon">Regnskap og Revisjon</option>
    <option value="Eiendomsmegling">Eiendomsmegling</option>
    <option value="Informasjonssystemer">Informasjonssystemer</option>
    <option value="Informatikk">Informatikk</option>
    <option value="Innovasjon og Entreprenørskap">Innovasjon og Entreprenørskap</option>
    <option value="Internasjonal Markedsføring">Internasjonal Markedsføring</option>
    <option value="Turisme og Ledelse">Turisme og Ledelse</option>
    <option value="Økonomi og Administrasjon">Økonomi og Administrasjon</option>
</optgroup>

<optgroup label="Institutt for Idrett og Friluftsliv">
    <option value="Trenerutdannelse i Idrett">Trenerutdannelse i Idrett</option>
    <option value="Fysisk Aktivitet og Helse">Fysisk Aktivitet og Helse</option>
    <option value="Idrettsadministrasjon og Ledelse">Idrettsadministrasjon og Ledelse</option>
    <option value="Friluftsliv, Kultur- og Naturveileder">Friluftsliv, Kultur- og Naturveileder</option>
    <option value="Master i Kroppsøving, Idrett- og Friluftsliv">Master i Kroppsøving, Idrett- og Friluftsliv</option>
</optgroup>

<optgroup label="Institutt for Kultur og Humanistiske fag">
    <option value="Språk og Litteratur">Språk og Litteratur</option>
    <option value="Engelsk">Engelsk</option>
    <option value="Kulturledelse">Kulturledelse</option>
    <option value="Historiske Fag">Historiske Fag</option>
    <option value="Kulturstudier">Kulturstudier</option>
</optgroup>

<optgroup label="Institutt for Natur, Helse- og Miljø">
    <option value="Økologi og Naturforvaltning">Økologi og Naturforvaltning</option>
    <option value="Forurensing og Miljø">Forurensing og Miljø</option>
    <option value="Natur-, Helse- og Miljøvern">Natur-, Helse- og Miljøvern</option>
    <option value="Akvatisk Økologi">Akvatisk Økologi</option>
    <option value="Environmental Science">Environmental Science</option>
    <option value="Alpine Ecology">Alpine Ecology</option>
</optgroup>

<optgroup label="Institutt for Helsefag">
    <option value="Sykepleie">Sykepleie</option>
</optgroup>

<optgroup label="Institutt for Sosialfag">
    <option value="Barnevern i et Flerkulturelt Samfunn">Barnevern i et Flerkulturelt Samfunn</option>
    <option value="Vernepleie">Vernepleie</option>
</optgroup>

<optgroup label="Institutt for Elektro, IT og Kybernetikk">
    <option value="Elkraftteknikk">Elkraftteknikk</option>
    <option value="Informatikk og Automatisering">Informatikk og Automatisering</option>
    <option value="Industrial IT and Automation">Industrial IT and Automation</option>
    <option value="Electrical Power Engineering">Electrical Power Engineering</option>
</optgroup>

<optgroup label="Institutt for Prosess, Energi og Miljøteknologi">
    <option value="Byggdesign">Byggdesign</option>
    <option value="Maskinteknisk Design">Maskinteknisk Design</option>
    <option value="Plan og Infrastruktur">Plan og Infrastruktur</option>
    <option value="Gass- og Energiteknologi">Gass- og Energiteknologi</option>
    <option value="Energy and Environmental Technology">Energy and Environmental Technology</option>
    <option value="Process Technology">Process Technology</option>
</optgroup>

<optgroup label="Institutt for Læreutdanning">
    <option value="Grunnskolelærer, 5. - 10. trinn">Grunnskolelærer, 5. - 10. trinn</option>
    <option value="Grunnskolelærer, 1. - 7. trinn">Grunnskolelærer, 1. - 7. trinn</option>
    <option value="Barnehagelærer">Barnehagelærer
    </option>
</optgroup>