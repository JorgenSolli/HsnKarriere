/*!
 * FileInput <_LANG_> Translations
 *
 * This file must be loaded after 'fileinput.js'. Patterns in braces '{}', or
 * any HTML markup tags in the messages must not be converted or translated.
 *
 * @see http://github.com/kartik-v/bootstrap-fileinput
 *
 * NOTE: this file must be saved in UTF-8 encoding.
 */
(function ($) {
    "use strict";

    $.fn.fileinputLocales['no'] = {
        fileSingle: 'fil',
        filePlural: 'filer',
        browseLabel: 'Bla gjennom &hellip;',
        removeLabel: 'Fjern',
        removeTitle: 'Fjern markerte filer',
        cancelLabel: 'Avbryt',
        cancelTitle: 'Avbryt pågående opplasting',
        uploadLabel: 'Last opp',
        uploadTitle: 'Last opp valgte filer',
        msgNo: 'Nei',
        msgNoFilesSelected: 'Ingen filer er valgt',
        msgCancelled: 'Avbrutt',
        msgZoomModalHeading: 'Detaljert forhåndsvisning',
        msgSizeTooSmall: 'Filen "{name}" (<b>{size} KB</b>) er for liten og må være større enn <b>{minSize} KB</b>.',
        msgSizeTooLarge: 'Filen "{name}" (<b>{size} KB</b>) er for stor! Maksimal størrelse er <b>{maxSize} KB</b>.',
        msgFilesTooLess: 'Du må velge minst <b>{n}</b> {files} for å laste opp.',
        msgFilesTooMany: 'Total antall filer for opplasing <b>({n})</b> overgår den maksimale grensen på <b>{m}</b>.',
        msgFileNotFound: 'Filen "{name}" ble ikke funnet!',
        msgFileSecured: 'Av sikkerhetsmessige årsaker kan ikke filen "{name}" leses".',
        msgFileNotReadable: 'Filen "{name}" kan ikke leses.',
        msgFilePreviewAborted: 'Forhåndsvisning avbrutt "{name}".',
        msgFilePreviewError: 'En feil oppstod under lesing av filen "{name}".',
        msgInvalidFileName: 'Filen "{name}" er ugyldid eller har ugyldige karakterer i seg".',
        msgInvalidFileType: 'Ugyldig type for filen "{name}". Kun "{types}" støttes.',
        msgInvalidFileExtension: 'Ugyldig filtype for filen "{name}". Kun "{extensions}" støttes.',
        msgFileTypes: {
            'image': 'bilde',
            'html': 'HTML',
            'text': 'tekst',
            'video': 'video',
            'audio': 'lyd',
            'flash': 'flash',
            'pdf': 'PDF',
            'object': 'objekt'
        },
        msgUploadAborted: 'Opplastingen ble avbrutt',
        msgUploadThreshold: 'Bahandler...',
        msgUploadEmpty: 'Ingen gyldige data er tilgjengelig for opplasting.',
        msgValidationError: 'Valideringsfeil!',
        msgLoading: 'Laster fil {index} av {files} &hellip;',
        msgProgress: 'Laster fil {index} av {files} - {name} - {percent}% fullført.',
        msgSelected: '{n} {files} markert',
        msgFoldersNotAllowed: 'Kun dra & slipp filer! Hoppet over {n} folder(s).',
        msgImageWidthSmall: 'Bredden på bildet "{name}" må være minst {size} px.',
        msgImageHeightSmall: 'Høyden på bildet "{name}" må være minst {size} px.',
        msgImageWidthLarge: 'Bredden på bildet "{name}" Kan ikke overstige {size} px.',
        msgImageHeightLarge: 'Høyden på bildet "{name}" kan ikke overstige {size} px.',
        msgImageResizeError: 'Kunne ikke hente størrelsen på bildet.',
        msgImageResizeException: 'Feil under endring av bildets størrelse.<pre>{errors}</pre>',
        dropZoneTitle: 'Dra og slipp filer her, eller trykk "Bla gjennom" &hellip;',
        dropZoneClickTitle: '<br>(eller klikk for å velge {files})',
        fileActionSettings: {
            removeTitle: 'Fjern fil',
            uploadTitle: 'Last opp fil',
            zoomTitle: 'Vis detaljer',
            dragTitle: 'Flytt / Arranger',
            indicatorNewTitle: 'Ikke opplastet enda',
            indicatorSuccessTitle: 'Opplastet',
            indicatorErrorTitle: 'Opplastingsfeil',
            indicatorLoadingTitle: 'Laster opp ...'
        },
        previewZoomButtonTitles: {
            prev: 'Vis forrige fil',
            next: 'Vis neste fil',
            toggleheader: 'Veksle header',
            fullscreen: 'Veksle fullskjerm',
            borderless: 'Veksle remmeløsmodus',
            close: 'Lukk detaljert visning'
        }
    };
})(window.jQuery);