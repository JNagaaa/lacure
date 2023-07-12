import './bootstrap';
import jQuery from 'jquery';
window.$ = jQuery;


$.ajaxSetup({
    headers: {
       'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
 });

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

$(document).ready(function() {
    $('#addDishContent').on('click', function() {
        $.ajax({
            url: '/admin/horeca/dishes',
            type: 'GET',
            success: function(response) {
                $('#dishesTypeContent').empty();
                var dishes = response.dishes; // Accédez au tableau des plats
                var dishTypes = response.dishTypes; // Accédez au tableau des types de plat
                
                var html = '<a href="/admin/horeca/dishes/create" class="btn btn-primary">Ajouter un nouveau plat</a>';
                
                // Création du select avec les options des types de plat
                html += '<select id="dishTypeSelect">';
                html += '<option value="">Sélectionnez un type de plat</option>';
                for (var i = 0; i < dishTypes.length; i++) {
                    var dishType = dishTypes[i];
                    html += '<option value="' + dishType.id + '">' + dishType.name + '</option>';
                }
                html += '</select>';

                // Creation of the dishes list div
                html += '<div id="dishesList">';

                // Boucle pour afficher les plats
                for (var i = 0; i < dishes.length; i++) {
                    var dish = dishes[i];
                    
                    html += '<li class="list-group-item d-flex justify-content-between align-items-center">';
                    html += dish.name;
                    html += '<div>';
                    html += '<a href="/admin/horeca/dishes/edit/' + dish.id + '" class="btn btn-warning active" role="button">Modifier</a>';
                    html += '<a href="/dishes/delete/' + dish.id + '" class="btn btn-danger active" role="button" onclick="return confirm(\'Etes-vous sûr de vouloir supprimer ce plat?\')">Supprimer</a>';
                    html += '</div>';
                    html += '</li>';                    
                }

                html += '</div>'; // closing the div here

                $('#dishesContent').html(html);

                $('#dishTypeSelect').on('change', function() {
                    var selectedType = $(this).val();
                    
                    $.ajax({
                        url: '/admin/horeca/dishes/filter',
                        type: 'GET',
                        data: { type: selectedType },
                        success: function(response) {
                            var filteredDishes = response.dishesByType.data;
                            var html = '';
                            for (var i = 0; i < filteredDishes.length; i++) {
                                var dish = filteredDishes[i];
                                html += '<li class="list-group-item d-flex justify-content-between align-items-center">';
                                html += dish.name;
                                html += '<div>';
                                html += '<a href="/admin/horeca/dishes/edit/' + dish.id + '" class="btn btn-warning active" role="button">Modifier</a>';
                                html += '<a href="/dishes/delete/' + dish.id + '" class="btn btn-danger active" role="button" onclick="return confirm(\'Etes-vous sûr de vouloir supprimer ce plat?\')">Supprimer</a>';
                                html += '</div>';
                                html += '</li>';
                            }
                            $('#dishesList').html(html);
                        }
                    });
                });
            }
        });
    });
});





$(document).ready(function() {
    var isNewTypeAdded = false;
    $('#addDishTypeContent').on('click', function() {
        $('#dishesContent').empty();

        $.ajax({
            url: '/admin/horeca/dishes/types/list',
            type: 'GET',
            success: function(response) {
                $('#dishesContent').html(response);
            }
        });
    });

    $('#dishesContent').on('click', '#addNewType', function() {
        if(isNewTypeAdded){
            $('#createType').empty();
            isNewTypeAdded = false;
        } else {
            $.ajax({
                url: '/admin/horeca/dishes/types/create',
                type: 'GET',
                success: function(response) {
                    $('#createType').html(response);
                    isNewTypeAdded = true;
                }
            });
        }
    });

    // Attach event handler for .edit-btn inside #dishesContent
    $('#dishesContent').on('click', '#edit-btn', function() {
        var $li = $(this).closest('li');
        var dishTypeName = $li.find('.dishTypeName').text();
        var dishTypeId = $(this).data('id');

        var inputField = `<input type="text" value="${dishTypeName}" id="editField${dishTypeId}" />`;
        var updateBtn = `<button class="update-btn" data-id="${dishTypeId}">Update</button>`;
        $li.find('.dishTypeName').replaceWith(inputField);
        $(this).replaceWith(updateBtn);
    });

    $('#dishesContent').on('click', '.update-btn', function() {
        var $button = $(this);
        var dishTypeId = $button.data('id');
        var $inputField = $(`#editField${dishTypeId}`);
        var updatedDishTypeName = $inputField.val();
        var csrfToken = "{{ csrf_token() }}";
        $.ajax({
            url: `/dishes/types/update/${dishTypeId}`,
            type: 'POST',
            data: {
                name: updatedDishTypeName,
            },
            
            success: function() {
                
                var successMessage = '<div class="alert alert-success">Type de plat modifié avec succès!</div>';
                $('#success-message-container').html(successMessage);

                setTimeout(function() {
                    location.reload();
                }, 2000);
            }
        });
    });
});



// 

$(document).ready(function() {
    $('#addDrinkContent').on('click', function() {
        $.ajax({
            url: '/admin/horeca/drinks',
            type: 'GET',
            success: function(response) {
                $('#drinksTypeContent').empty();
                var drinks = response.drinks; // Accédez au tableau des boissons
                var drinkTypes = response.drinkTypes; // Accédez au tableau des types de boisson
                
                var html = '<a href="/admin/horeca/drinks/create" class="btn btn-primary">Ajouter une nouvelle boisson</a>';
                
                // Création du select avec les options des types de boisson
                html += '<select id="drinkTypeSelect">';
                html += '<option value="">Sélectionnez un type de boisson</option>';
                for (var i = 0; i < drinkTypes.length; i++) {
                    var drinkType = drinkTypes[i];
                    html += '<option value="' + drinkType.id + '">' + drinkType.name + '</option>';
                }
                html += '</select>';

                // Creation of the drinks list div
                html += '<div id="drinksList">';

                // Boucle pour afficher les boissons
                for (var i = 0; i < drinks.length; i++) {
                    var drink = drinks[i];
                    
                    html += '<li class="list-group-item d-flex justify-content-between align-items-center">';
                    html += drink.name;
                    html += '<div>';
                    html += '<a href="/admin/horeca/drinks/edit/' + drink.id + '" class="btn btn-warning active" role="button">Modifier</a>';
                    html += '<a href="/drinks/delete/' + drink.id + '" class="btn btn-danger active" role="button" onclick="return confirm(\'Etes-vous sûr de vouloir supprimer cette boisson?\')">Supprimer</a>';
                    html += '</div>';
                    html += '</li>';                    
                }

                html += '</div>';

                $('#drinksContent').html(html);

                $('#drinkTypeSelect').on('change', function() {
                    var selectedType = $(this).val();
                    
                    $.ajax({
                        url: '/admin/horeca/drinks/filter',
                        type: 'GET',
                        data: { type: selectedType },
                        success: function(response) {
                            var filteredDrinks = response.drinksByType.data;
                            var html = '';
                            for (var i = 0; i < filteredDrinks.length; i++) {
                                var drink = filteredDrinks[i];
                                html += '<li class="list-group-item d-flex justify-content-between align-items-center">';
                                html += drink.name;
                                html += '<div>';
                                html += '<a href="/admin/horeca/drinks/edit/' + drink.id + '" class="btn btn-warning active" role="button">Modifier</a>';
                                html += '<a href="/drinks/delete/' + drink.id + '" class="btn btn-danger active" role="button" onclick="return confirm(\'Etes-vous sûr de vouloir supprimer cette boisson?\')">Supprimer</a>';
                                html += '</div>';
                                html += '</li>';
                            }
                            $('#drinksList').html(html);
                        }
                    });
                });
            }
        });
    });
});





$(document).ready(function() {
    var isNewTypeAdded = false;
    $('#addDrinkTypeContent').on('click', function() {
        $('#drinksContent').empty();

        $.ajax({
            url: '/admin/horeca/drinks/types/list',
            type: 'GET',
            success: function(response) {
                $('#drinksContent').html(response);
            }
        });
    });

    $('#drinksContent').on('click', '#addNewType', function() {
        if(isNewTypeAdded){
            $('#createType').empty();
            isNewTypeAdded = false;
        } else {
            $.ajax({
                url: '/admin/horeca/drinks/types/create',
                type: 'GET',
                success: function(response) {
                    $('#createType').html(response);
                    isNewTypeAdded = true;
                }
            });
        }
    });

    // Attach event handler for .edit-btn inside #drinksContent
    $('#drinksContent').on('click', '#edit-btn', function() {
        var $li = $(this).closest('li');
        var drinkTypeName = $li.find('.drinkTypeName').text();
        var drinkTypeId = $(this).data('id');

        var inputField = `<input type="text" value="${drinkTypeName}" id="editField${drinkTypeId}" />`;
        var updateBtn = `<button class="update-btn" data-id="${drinkTypeId}">Update</button>`;
        $li.find('.drinkTypeName').replaceWith(inputField);
        $(this).replaceWith(updateBtn);
    });

    $('#drinksContent').on('click', '.update-btn', function() {
        var $button = $(this);
        var drinkTypeId = $button.data('id');
        var $inputField = $(`#editField${drinkTypeId}`);
        var updatedDrinkTypeName = $inputField.val();
        var csrfToken = "{{ csrf_token() }}";
        $.ajax({
            url: `/drinks/types/update/${drinkTypeId}`,
            type: 'POST',
            data: {
                name: updatedDrinkTypeName,
            },
            
            success: function() {
                
                var successMessage = '<div class="alert alert-success">Type de boisson modifié avec succès!</div>';
                $('#success-message-container').html(successMessage);

                setTimeout(function() {
                    location.reload();
                }, 2000);
            }
        });
    });
});
