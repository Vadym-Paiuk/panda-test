let $ = jQuery.noConflict()

$( document ).on( 'click', '.js-add-row', function (e){
    e.preventDefault()

    let wrapper = $( '.js-wrapper' ),
        row = $( '.js-row' ).first().clone()

    row.find( 'input' ).val(0)
    row.find( 'textarea' ).val('')

    wrapper.append( row )
} )

$( document ).on( 'click', '.js-remove-row', function (e){
    e.preventDefault()

    let close = $( this ),
        wrapper = close.closest( '.js-row' )

    wrapper.remove()
} )