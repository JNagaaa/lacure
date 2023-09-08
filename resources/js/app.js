import './bootstrap';
import jQuery from 'jquery';
import tinymce from 'tinymce/tinymce';
import 'tinymce/themes/silver/theme';


window.$ = jQuery;


$.ajaxSetup({
    headers: {
       'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
 });

 $(document).ready(function() {
    tinymce.init({
        selector: 'textarea.tinymce-editor',
        plugins: 'advlist autolink lists link image charmap preview anchor',
        toolbar: 'undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image',

    });
 });

 $('document').ready(function () {
    document.getElementById('bookingDate').min = new Date().toISOString().split('T')[0];
 });

 $('document').ready(function () {
    document.getElementById('bookingTableDate').min = new Date().toISOString().split('T')[0];
 });
 

 $('document').ready(function () {
    $("#imgload").change(function () {
        if (this.files && this.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#imgshow').attr('src', e.target.result);
            }
            reader.readAsDataURL(this.files[0]);
        }
    });
});

 $(document).ready(function() {
    $.ajax({
        url: '/notifications/unread', 
        method: 'GET',
        dataType: 'json',
        success: function(response) {
            const numberNotif = document.getElementById('numberNotif');
            numberNotif.append(response.numberNotif);
        }
    });
});
            

$(document).ready(function() {
    document.getElementById('notifications-dropdown').addEventListener('click', function(event) {
        event.preventDefault(); // Empêche le comportement par défaut du lien
        
        $.ajax({
            url: '/notifications/unread', 
            method: 'GET',
            dataType: 'json',
            success: function(response) {
                const notificationsList = document.getElementById('notifications-list');
                notificationsList.innerHTML = ''; // Nettoie la liste des notifications précédentes

                const notifications = response.notifications;

                if (notifications.length === 0) {
                    // Si aucune notification non lue
                    notificationsList.innerHTML = '<div>Aucune notification non lue</div>';
                } else {
                    // S'il y a des notifications non lues
                    notifications.forEach(notification => {
                        const notificationItem = document.createElement('div');
                        notificationItem.classList.add('notification-item');

                        // Calcule le temps écoulé
                        const createdAt = new Date(notification.created_at);
                        const now = new Date();
                        const diffInSeconds = Math.floor((now - createdAt) / 1000);

                        // Fonction pour afficher le temps écoulé en français
                        const formatTimeAgo = (value, unit) => {
                            if (value === 1) {
                                return value + ' ' + unit;
                            } else {
                                return value + ' ' + unit + 's';
                            }
                        };

                        let timeAgo = '';
                        if (diffInSeconds < 60) {
                            timeAgo = formatTimeAgo(diffInSeconds, 'seconde');
                        } else if (diffInSeconds < 3600) {
                            const diffInMinutes = Math.floor(diffInSeconds / 60);
                            timeAgo = formatTimeAgo(diffInMinutes, 'minute');
                        } else if (diffInSeconds < 86400) {
                            const diffInHours = Math.floor(diffInSeconds / 3600);
                            timeAgo = formatTimeAgo(diffInHours, 'heure');
                        } else if (diffInSeconds < 2592000) {
                            const diffInDays = Math.floor(diffInSeconds / 86400);
                            timeAgo = formatTimeAgo(diffInDays, 'jour');
                        } else if (diffInSeconds < 31536000) {
                            const diffInMonths = Math.floor(diffInSeconds / 2592000);
                            timeAgo = formatTimeAgo(diffInMonths, 'mois');
                        } else {
                            const diffInYears = Math.floor(diffInSeconds / 31536000);
                            timeAgo = formatTimeAgo(diffInYears, 'an');
                        }

                        notificationItem.innerHTML = `
                            ${notification.data.message} (Il y a ${timeAgo})</div></a>
                        `;

                        notificationItem.addEventListener('click', function() {
                            // Marquer la notification comme lue
                            $.ajax({
                                url: `/notifications/mark-as-read/${notification.id}`,
                                method: 'PUT',
                                dataType: 'json',
                                success: function() {
                                    
                                },
                                error: function(error) {
                                    console.error(error);
                                }
                            });
                        });
                        notificationsList.appendChild(notificationItem);
                    });
                }
            },
            error: function(error) {
                console.error(error);
            }
        });
    });
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








$(document).ready(function() {
    $('#searchInput').on('input', function() {
        var searchTerm = $(this).val();

        if (searchTerm.trim() === '') {
            $('#users-list').empty(); // Effacer la liste des utilisateurs si la barre de recherche est vide
            return;
        }

        $.ajax({
            url: '/users/search',
            type: 'GET',
            data: { search: searchTerm },
            success: function(response) {
                var users = response.users;

                var html = '';
                for (var i = 0; i < users.length; i++) {
                    var user = users[i];
            
                    // Utilisez la concaténation normale pour ajouter la variable user.id à l'URL
                    var url = '/users/one/' + user.id;
            
                    html += '<a href="' + url + '">';
                    html += '<li class="list-group-item d-flex justify-content-between align-items-center">';
                    html += user.name + ' ' + user.lastname;
                    html += '</li></a>';
                }

                $('#users-list').html(html);
            }
        });
    });
});



/********** PLAGES HORAIRES **********/

//Sports
$(document).ready(function() {
    var isNewTimeslotAdded = false;
    

    $('#timeslotsContent').on('click', '#create', function() {
        if(isNewTimeslotAdded){
            $('#createTimeslot').empty();
            isNewTimeslotAdded = false;
        } else {
            $.ajax({
                url: '/admin/sports/timeslots/create',
                type: 'GET',
                success: function(response) {
                    $('#createTimeslot').html(response);
                    isNewTimeslotAdded = true;
                }
            });
        }
    });

    $('#timeslotsContent').on('click', '.store-btn', function() {
        // Sélectionner le formulaire et obtenir ses données sérialisées
        event.preventDefault();
        var formData = $('#createTimeslotForm').serialize();
        console.log(formData);

        // Envoi du formulaire via une requête AJAX
        $.ajax({
            url: '/timeslots/store',
            type: 'POST',
            data: formData,
            success: function(response) {
                // Si la requête réussit, ajouter le nouveau timeslot à la liste
                // en utilisant les données de réponse reçues du serveur
                var newTimeslot = '<li class="list-group-item d-flex justify-content-between align-items-center">' +
                    '<span class="timeslot">' + response.startTime + ' -> ' + response.endTime + '</span>' +
                    '<div>' +
                    '<button type="button" class="edit-btn btn btn-warning active" role="button" data-id="' + response.id + '">Modifier</button>' +
                    '<a href="/timeslots/delete/' + response.id + '" class="delete-btn btn btn-danger active" role="button" onclick="return confirm(\'Etes-vous sûr de vouloir supprimer cette plage horaire?\')">Supprimer</a>' +
                    '</div>' +
                    '<div class="edit-fields" style="display: none;">' +
                    '<input type="text" class="start-time" value="' + response.startTime + '">' +
                    '<input type="text" class="end-time" value="' + response.endTime + '">' +
                    '<button type="button" class="update-btn btn btn-success" data-id="' + response.id + '">Enregistrer</button>' +
                    '<button type="button" class="cancel-btn btn btn-danger">Annuler</button>' +
                    '</div>' +
                    '</li>';

                $('#timeslotsContent').append(newTimeslot);

                // Réinitialiser le formulaire pour permettre d'ajouter d'autres timeslots sans recharger la page
                $('#createTimeslotForm')[0].reset();
            },
            error: function(error) {
                // Gérer les erreurs en cas de problème avec la requête AJAX
                console.error('Une erreur s\'est produite lors de la soumission du formulaire :', error);
            }
        });
    });

    $('#timeslotsContent').on('click', '.edit-btn', function() {
        var $li = $(this).closest('li');
        $li.find('.timeslot').hide();
        $li.find('.edit-fields').show();
        $li.find('.edit-btn').hide();
        $li.find('.delete-btn').hide();
    });
    
    $('#timeslotsContent').on('click', '.cancel-btn', function() {
        var $li = $(this).closest('li');
        $li.find('.timeslot').show();
        $li.find('.edit-fields').hide();
        $li.find('.edit-btn').show();
        $li.find('.delete-btn').show();
    });
    
    $('#timeslotsContent').on('click', '.update-btn', function() {
        var $li = $(this).closest('li');
        var timeslotId = $(this).data('id');
        var startTime = $li.find('.start-time').val();
        var endTime = $li.find('.end-time').val();
        
        $.ajax({
            url: `/timeslots/update/${timeslotId}`,
            type: 'POST',
            data: {
                start_time: startTime,
                end_time: endTime,
            },
            
            success: function() {
                
                var successMessage = '<div class="alert alert-success">Type de boisson modifié avec succès!</div>';
                $('#success-message-container').html(successMessage);

                
            }
        });
    
        // Une fois la mise à jour terminée, mettez à jour la vue avec les nouvelles valeurs
        $li.find('.timeslot').text(startTime + ' -> ' + endTime).show();
        $li.find('.edit-fields').hide();
        $li.find('.edit-btn').show();
        $li.find('.delete-btn').show();
    });

    $('#timeslotsContent').on('click', '.delete-btn', function() {
        event.preventDefault();
        var timeslotId = $(this).data('id');
        var timeslotElement = document.getElementById('timeslot_' + timeslotId);
    
        // Afficher la fenêtre de confirmation
        if (confirm('Etes-vous sûr de vouloir supprimer cette plage horaire?')) {
            // Effectuer une action de suppression ici, par exemple en utilisant AJAX pour supprimer le timeslot dans la base de données
            $.ajax({
                url: `/timeslots/delete/${timeslotId}`,
                type: 'GET',
                data: {
                    id: timeslotId
                },
                
                success: function() {
                    
                    var successMessage = '<div class="alert alert-success">Type de boisson modifié avec succès!</div>';
                    $('#success-message-container').html(successMessage);
    
                    
                }
            });
            // Une fois la suppression réussie, supprimer le timeslot de la page
            timeslotElement.remove();
        }
    });
});

//Horeca
$(document).ready(function() {
    var isNewTimeslotAdded = false;
    
    $('#timeslotsContentHoreca').on('click', '#createHoreca', function() {
        if(isNewTimeslotAdded){
            $('#createTimeslotHoreca').empty();
            isNewTimeslotAdded = false;
        } else {
            $.ajax({
                url: '/admin/horeca/timeslots/create',
                type: 'GET',
                success: function(response) {
                    $('#createTimeslotHoreca').html(response);
                    isNewTimeslotAdded = true;
                }
            });
        }
    });

    $('#timeslotsContentHoreca').on('submit', function() {
        // Sélectionner le formulaire et obtenir ses données sérialisées
        event.preventDefault();
        var formData = $('#createTimeslotFormHoreca').serialize();

        // Envoi du formulaire via une requête AJAX
        $.ajax({
            url: '/timeslots/store',
            type: 'POST',
            data: formData,
            success: function(response) {
                event.preventDefault();
                // Si la requête réussit, ajouter le nouveau timeslot à la liste
                // en utilisant les données de réponse reçues du serveur
                var newTimeslot = '<li class="list-group-item d-flex justify-content-between align-items-center">' +
                    '<span class="timeslotHoreca">' + response.startTime + '</span>' +
                    '<div>' +
                    '<button type="button" class="edit-btn btn btn-warning active" role="button" data-id="' + response.id + '">Modifier</button>' +
                    '<a href="/timeslots/delete/' + response.id + '" class="delete-btn btn btn-danger active" role="button" onclick="return confirm(\'Etes-vous sûr de vouloir supprimer cette plage horaire?\')">Supprimer</a>' +
                    '</div>' +
                    '<div class="edit-fields" style="display: none;">' +
                    '<input type="text" class="start-time" value="' + response.startTime + '">' +
                    '<button type="button" class="update-btn btn btn-success" data-id="' + response.id + '">Enregistrer</button>' +
                    '<button type="button" class="cancel-btn btn btn-danger">Annuler</button>' +
                    '</div>' +
                    '</li>';

                $('#timeslotsContentHoreca').append(newTimeslot);

                // Réinitialiser le formulaire pour permettre d'ajouter d'autres timeslots sans recharger la page
                $('#createTimeslotFormHoreca')[0].reset();
            },
            error: function(error) {
                // Gérer les erreurs en cas de problème avec la requête AJAX
                console.error('Une erreur s\'est produite lors de la soumission du formulaire :', error);
            }
        });
    });

    $('#timeslotsContentHoreca').on('click', '.edit-btn', function() {
        var $li = $(this).closest('li');
        $li.find('.timeslotHoreca').hide();
        $li.find('.edit-fields').show();
        $li.find('.edit-btn').hide();
        $li.find('.delete-btn').hide();
    });
    
    $('#timeslotsContentHoreca').on('click', '.cancel-btn', function() {
        var $li = $(this).closest('li');
        $li.find('.timeslotHoreca').show();
        $li.find('.edit-fields').hide();
        $li.find('.edit-btn').show();
        $li.find('.delete-btn').show();
    });
    
    $('#timeslotsContentHoreca').on('click', '.update-btn', function() {
        var $li = $(this).closest('li');
        var timeslotId = $(this).data('id');
        var startTime = $li.find('.start-time').val();
        
        $.ajax({
            url: `/timeslots/update/${timeslotId}`,
            type: 'POST',
            data: {
                start_time: startTime,
            },
            
            success: function() {
                
                var successMessage = '<div class="alert alert-success">Type de boisson modifié avec succès!</div>';
                $('#success-message-container').html(successMessage);

                
            }
        });
    
        // Une fois la mise à jour terminée, mettez à jour la vue avec les nouvelles valeurs
        $li.find('.timeslotHoreca').text(startTime).show();
        $li.find('.edit-fields').hide();
        $li.find('.edit-btn').show();
        $li.find('.delete-btn').show();
    });

    $('#timeslotsContentHoreca').on('click', '.delete-btn', function() {
        event.preventDefault();
        var timeslotId = $(this).data('id');
        var timeslotElement = document.getElementById('timeslot_' + timeslotId);
    
        // Afficher la fenêtre de confirmation
        if (confirm('Etes-vous sûr de vouloir supprimer cette plage horaire?')) {
            // Effectuer une action de suppression ici, par exemple en utilisant AJAX pour supprimer le timeslot dans la base de données
            $.ajax({
                url: `/timeslots/delete/${timeslotId}`,
                type: 'GET',
                data: {
                    id: timeslotId
                },
                
                success: function() {
                    
                    var successMessage = '<div class="alert alert-success">Plage horaire modifiée avec succès!</div>';
                    $('#success-message-container').html(successMessage);
    
                    
                }
            });
            // Une fois la suppression réussie, supprimer le timeslot de la page
            timeslotElement.remove();
        }
    });
});


////////////////


$(document).ready(function() {
    document.getElementById('bookingDate').addEventListener('change', function() {
        const selectedDate = this.value;
        const formattedDate = selectedDate.split('/').reverse().join('-');
        const fieldType = document.getElementById('fieldTypeSelect').value;
        const baseUrl = window.location.href.split('?')[0]; // Récupérer l'URL de base sans les paramètres

        // Rediriger vers la même page avec la nouvelle date et le fieldType dans l'URL
        window.location.href = `${baseUrl}?date=${formattedDate}`;
    });

    document.getElementById('fieldTypeSelect').addEventListener('change', function() {
        const fieldType = this.value;
        const selectedDate = document.getElementById('bookingDate').value;
        const formattedDate = selectedDate.split('/').reverse().join('-');

        // Effectuer la requête AJAX pour charger les terrains en fonction du type sélectionné
        $.ajax({
            url: `/setFieldType`,
            type: 'POST',
            data: {
                fieldType: fieldType,
                date: formattedDate
            },
            success: function(response) {
                console.log(response);
                // Afficher les terrains chargés dans le div "fieldsContainer"
                $('#fieldsContainer').html(response); // Met à jour le contenu du div avec les terrains chargés
            },
            error: function() {
                console.error('Raté!'); // Gérer les erreurs si besoin
            }
        });
    });
});



$(document).ready(function() {
    // Liste pour stocker les utilisateurs sélectionnés
    const selectedUsers = [];

    // Fonction pour effectuer la recherche d'utilisateurs
    function searchUsers(inputId, listId) {
        const searchTerm = $('#' + inputId).val();

        if (searchTerm.trim() === '') {
            // Si la barre de recherche est vide, vider la liste des résultats
            $('#' + listId).empty();
            return; // Sortir de la fonction sans effectuer la requête AJAX
        }
    
        // Effectuer la requête AJAX pour chercher les utilisateurs
        $.ajax({
            url: '/searchUsers', // Assurez-vous d'ajuster le chemin d'accès en fonction de votre contrôleur
            type: 'GET',
            data: { term: searchTerm }, // Utiliser le terme de recherche saisi par l'utilisateur
            success: function(response) {
                // Afficher les résultats dans la liste déroulante
                console.log(response);
                const list = $('#' + listId);
                list.empty();
                response.forEach(function(user) {
                    // Vérifier si l'utilisateur est déjà sélectionné
                    let isAlreadySelected = false;
                    for (const selectedUser of selectedUsers) {
                        if (selectedUser === user.id) { // Comparer avec l'ID réel de l'utilisateur
                            isAlreadySelected = true;
                            break;
                        }
                    }
                    if (!isAlreadySelected) {
                        list.append(`<li class="search-result-item">${user.name} ${user.lastname}</li>`);
                        // Ajouter l'ID réel de l'utilisateur comme attribut data-id du résultat de recherche
                        list.children().last().attr('data-id', user.id);
                    }
                });
            },
            error: function() {
                console.error('Erreur lors de la recherche d\'utilisateurs.');
            }
        });
    }  

    // Fonction pour ajouter un utilisateur sélectionné
    function addUserToList(inputId, user) {
        // Stocker l'utilisateur dans la liste des utilisateurs sélectionnés
        selectedUsers.push(user.id); // Ici, user.id doit être l'ID réel de l'utilisateur obtenu à partir de la réponse de recherche
        console.log(selectedUsers);
        // Remplacer la barre de recherche par le nom de l'utilisateur sélectionné
        const $searchWrapper = $('#' + inputId).closest('.search-wrapper');
        $searchWrapper.empty();
        $searchWrapper.append(`<span>${user.name} ${user.lastname} <button class="cancel-btn" data-id="${user.id}" data-list-id="${inputId}">Annuler</button></span>`);

        const hiddenInputId = inputId.replace('search', 'selectedUsers');
        $('#' + hiddenInputId).val(user.id);
    }

    function resetOtherSearchInputs(currentInputId) {
        for (var i = 1; i <= 4; i++) {
            const inputId = 'search' + i;
            const resultId = 'userList' + i;
            
            if (inputId !== currentInputId) {
                $('#' + inputId).val('');
                $('#' + resultId).empty();
            }

        }
    }

    // Gérer l'événement "keyup" pour chaque barre de recherche
    function setupSearchListener() {
        for (var i = 1; i <= 4; i++) {
            $('#search' + i).on('keyup', function() {
                const inputId = $(this).attr('id');
                const listId = $(this).data('id'); // Utiliser un attribut personnalisé pour identifier la liste des résultats
                searchUsers(inputId, listId);
            });
    }}

    setupSearchListener();

    // Gérer l'événement de clic sur un résultat de recherche
    $(document).on('click', 'li.search-result-item', function() {
        const name = $(this).text();
        const [firstName, lastName] = name.split(' ');
    
        // Ajouter l'utilisateur sélectionné à la liste des utilisateurs sélectionnés
        const inputId = $(this).parent().siblings('.search-input').attr('id');
        const userId = $(this).data('id'); // Obtenir l'ID réel de l'utilisateur à partir de l'attribut data-id
        addUserToList(inputId, { id: userId, name: firstName, lastname: lastName });
    
        // Effacer le résultat sélectionné de la liste déroulante
        $(this).remove();

        resetOtherSearchInputs(inputId);

        const hiddenInputId = inputId.replace('search', 'selectedUsers');
        console.log(hiddenInputId);
        $('#' + hiddenInputId).val(userId);
    });

    // Gérer l'événement de clic sur le bouton "Annuler"
    $(document).on('click', '.cancel-btn', function() {
        const userId = $(this).data('id');

        // Supprimer l'utilisateur de la liste des utilisateurs sélectionnés
        selectedUsers.splice(selectedUsers.findIndex(user => user.id === userId), 1);

        // Remettre la barre de recherche à son état initial
        const inputId = $(this).data('list-id');
        const $searchWrapper = $(this).closest('.search-wrapper');
        $searchWrapper.empty();
        $searchWrapper.append(`
            <input type="text" class="form-control search-input" id="${inputId}" data-id="userList${inputId.substr(inputId.length - 1)}">
            <ul class="search-results" id="userList${inputId.substr(inputId.length - 1)}"></ul>
        `);

        setupSearchListener();

        const hiddenInputId = inputId.replace('search', 'selectedUsers');
        $('#' + hiddenInputId).val('');

        resetOtherSearchInputs(inputId);

        // Recharger les résultats de recherche pour masquer l'utilisateur supprimé
        const listId = $(this).data('list-id').substr(inputId.length - 1);
        searchUsers(inputId, listId);
    });
});






$(document).ready(function() {
    $('#dishesBtn').on('click', function() {
        $.ajax({
            url: '/horeca/menu/dishes',
            type: 'GET',
            success: function(response) {
                $('#drinks').empty();
                var dishes = response.dishes; // Accédez au tableau des plats
                var dishTypes = response.dishTypes; // Accédez au tableau des types de plat
                
                
                
                // Création du select avec les options des types de plat
                var html = '<select id="dishTypeSelect">';
                html += '<option value="">Tous les plats</option>';
                for (var i = 0; i < dishTypes.length; i++) {
                    var dishType = dishTypes[i];
                    html += '<option value="' + dishType.id + '">' + dishType.name + 's</option>';
                }
                html += '</select>';

                // Creation of the dishes list div
                html += '<div id="dishesList">';
                html += '<div class="row">';
                var baseUrl = $('#dishes').data('base-url');

                // Boucle pour afficher les plats
                for (var i = 0; i < dishes.length; i++) {
                    var dish = dishes[i];
                    if(dish.image != 'defaultPlate.png') {
                        var baseUrl = $('#dishes').data('base-url');
                    } else {
                        var baseUrl = $('#dishesNull').data('base-url');
                    }
                    
                    html += '<div class="card col mb-3 p-0 me-1 ms-1 text-center" style="min-width: 150px;">';
                    html += '<div class="card-header">'
                    html += '<img src="' + baseUrl + '/' + dish.image + '" style="width:100px; height:100px; border-radius:10%;"/><br>';
                    html += dish.name;
                    html += '</div><div class="card-body me-2 ms-2">'
                    html += dish.description;
                    html += '<br>';
                    html += dish.price;
                    html += 'euros</div></div>';
                }

                html += '</div></div>'; // closing the div here

                $('#dishes').html(html);

                $('#dishTypeSelect').on('change', function() {
                    var selectedType = $(this).val();
                    
                    $.ajax({
                        url: '/admin/horeca/dishes/filter',
                        type: 'GET',
                        data: { type: selectedType },
                        success: function(response) {
                            var filteredDishes = response.dishesByType.data;
                            var html = '<div class="row">';
                            for (var i = 0; i < filteredDishes.length; i++) {
                                var dish = filteredDishes[i];
                                if(dish.image != 'defaultPlate.png') {
                                    var baseUrl = $('#dishes').data('base-url');
                                } else {
                                    var baseUrl = $('#dishesNull').data('base-url');
                                }
                                
                                html += '<div class="card col mb-3 p-0 me-1 ms-1 text-center" style="min-width: 150px;">';
                                html += '<div class="card-header">'
                                html += '<img src="' + baseUrl + '/' + dish.image + '" style="width:100px; height:100px; border-radius:10%;"/><br>';
                                html += dish.name;
                                html += '</div><div class="card-body me-2 ms-2">'
                                html += dish.description;
                                html += '<br>';
                                html += dish.price;
                                html += 'euros</div></div>';
                            }
                            html += '</div>';
                            $('#dishesList').html(html);
                        }
                    });
                });
            }
        });
    });
});


$(document).ready(function() {
    $('#drinksBtn').on('click', function() {
        $.ajax({
            url: '/horeca/menu/drinks',
            type: 'GET',
            success: function(response) {
                $('#dishes').empty();
                var drinks = response.drinks; // Accédez au tableau des plats
                var drinkTypes = response.drinkTypes; // Accédez au tableau des types de plat
                
                
                
                // Création du select avec les options des types de plat
                var html = '<select id="drinkTypeSelect">';
                html += '<option value="">Toutes les boissons</option>';
                for (var i = 0; i < drinkTypes.length; i++) {
                    var drinkType = drinkTypes[i];
                    html += '<option value="' + drinkType.id + '">' + drinkType.name + 's</option>';
                }
                html += '</select>';

                // Creation of the drinks list div
                html += '<div id="drinksList">';
                html += '<div class="row">';

                // Boucle pour afficher les plats
                for (var i = 0; i < drinks.length; i++) {
                    var drink = drinks[i];
                    if(drink.image != 'defaultDrink.png') {
                        var baseUrl = $('#dishes').data('base-url');
                    } else {
                        var baseUrl = $('#dishesNull').data('base-url');
                    }
                    
                    html += '<div class="card col mb-3 p-0 me-1 ms-1 text-center" style="min-width: 150px;">';
                    html += '<div class="card-header">'
                    html += '<img src="' + baseUrl + '/' + drink.image + '" style="width:100px; height:100px; border-radius:10%;"/><br>';
                    html += drink.name;
                    html += '</div><div class="card-body me-2 ms-2">'
                    html += drink.description;
                    html += '</div></div>';
                }

                html += '</div></div>'; // closing the div here

                $('#drinks').html(html);

                $('#drinkTypeSelect').on('change', function() {
                    var selectedType = $(this).val();
                    
                    $.ajax({
                        url: '/admin/horeca/drinks/filter',
                        type: 'GET',
                        data: { type: selectedType },
                        success: function(response) {
                            var filteredDrinks = response.drinksByType.data;
                            var html = '<div class="row">';
                            for (var i = 0; i < filteredDrinks.length; i++) {
                                var drink = filteredDrinks[i];
                                if(drink.image != 'defaultDrink.png') {
                                    var baseUrl = $('#drinks').data('base-url');
                                } else {
                                    var baseUrl = $('#drinksNull').data('base-url');
                                }
                                
                                html += '<div class="card col mb-3 p-0 me-1 ms-1 text-center" style="min-width: 150px;">';
                                html += '<div class="card-header">'
                                html += '<img src="' + baseUrl + '/' + drink.image + '" style="width:100px; height:100px; border-radius:10%;"/><br>';
                                html += drink.name;
                                html += '</div><div class="card-body me-2 ms-2">'
                                html += drink.description;
                                html += '</div></div>';
                            }
                            html += '</div>';
                            $('#drinksList').html(html);
                        }
                    });
                });
            }
        });
    });
});


$(document).ready(function() {
    document.getElementById('bookingTableDate').addEventListener('change', function() {
        const selectedDate = this.value;
        const formattedDate = selectedDate.split('/').reverse().join('-');
        const baseUrl = window.location.href.split('?')[0]; // Récupérer l'URL de base sans les paramètres

        // Rediriger vers la même page avec la nouvelle date et le fieldType dans l'URL
        window.location.href = `${baseUrl}?date=${formattedDate}`;
    });
});


// Mes réservations
$('#reservationTypeSelect').on('change', function() {
    var selectedType = $(this).val();
    var userId = $(this).data('base-url');
    
    // Vérifiez si "Réservations sportives" est sélectionné
    if (selectedType === 'sport') {
        $('#reservationsList').empty();
        // Effectuez la requête AJAX pour charger la vue
        $.ajax({
            type: 'GET',
            url: '/reservations/listSports/' + userId,
            success: function(response) {
                // Insérez le contenu de la vue dans la div #reservationsList
                $('#reservationsList').html(response);
            },
        });
    }else if(selectedType === 'horeca') {
        $('#reservationsList').empty();
        // Effectuez la requête AJAX pour charger la vue
        $.ajax({
            type: 'GET',
            url: '/reservations/listHoreca/' + userId,
            success: function(response) {
                // Insérez le contenu de la vue dans la div #reservationsList
                $('#reservationsList').html(response);
            },
        });
    }else {
        $('#reservationsList').empty();
        // Effectuez la requête AJAX pour charger la vue
        $.ajax({
            type: 'GET',
            url: '/reservations/list/' + userId,
            success: function(response) {
                // Insérez le contenu de la vue dans la div #reservationsList
                $('#reservationsList').html(response);
            },
        });
    }
});

