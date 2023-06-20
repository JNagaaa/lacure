import './bootstrap';
import jQuery from 'jquery';
window.$ = jQuery;

$(document).ready(function() {
    $('#field-type').on('change', function() {
        
        var selectedType = $(this).val();

        // Effectuer la requête Ajax pour récupérer les terrains filtrés
        $.ajax({
            url: '/fields/filter',
            type: 'GET',
            data: { type: selectedType },
            success: function(response) {
                
                var fields = response.data.data;
                console.log(response);

                var html = '';
                for (var i = 0; i < fields.length; i++) {
                    var field = fields[i];
                    html += '<li class="list-group-item d-flex justify-content-between align-items-center">';
                    html += 'Terrain numéro ' + field.number;
                    html += '<div>';
                    html += '<a href="/admin/sports/fields/edit/' + field.id + '" class="btn btn-warning active" role="button">Modifier</a>';
                    html += '<a href="/fields/delete/' + field.id + '" class="btn btn-danger active" role="button" onclick="return confirm(\'Etes-vous sûr de vouloir supprimer ce terrain?\')">Supprimer</a>';
                    html += '</div>';
                    html += '</li>';
                }
        
                $('#fields-list').html(html);
            }
        });
    });
});
