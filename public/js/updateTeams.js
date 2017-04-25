function updateTeams() {
    $('tr').each(function(index, elem) {
        var teamId = elem['team_id'];
        $.getJSON('/lifts/' + teamId, null, function(data){
            Object.keys(data).forEach(function(lift) {
                var elem = $(this).find('[for_lift=' + lift + ']');
                elem.text(data[lift]);
            })
        });
    })
}
