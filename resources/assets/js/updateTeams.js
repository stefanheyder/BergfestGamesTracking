function updateTeams() {
    $('tbody').find('tr').each(function(index, elem) {
        var teamId = $(elem).attr('data');
        $.getJSON('/lifts/' + teamId, null, function(data){
            Object.keys(data).forEach(function(lift) {
                var nextElem = $(elem).find('.' + lift);
                var current = parseInt(nextElem.text());
                if (current < data[lift]) {
                    nextElem.fadeTo(100, 0.3, function() { $(this).fadeTo(500, 1.0); });
                    nextElem.text(data[lift]);
                }

            })
        });
    })
}

function scoring() {

}

window.setInterval(updateTeams, 1500);
