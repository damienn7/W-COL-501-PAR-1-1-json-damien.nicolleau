(function ( $ ) { 

    

    $(function () {
        $('#show_recipes').click(function (event) {
            event.preventDefault();
            $.ajax({
                url: './recipes.json',
                dataType: 'json',
                success: function (data) {
                    var items = [];
                    let text='';
                    text += '<div class="container">';
                    $.each(data, function (key, val) {
                        $('#recipe'+val.recipe_id).click(function(event){
                            let id_all_recipe = event.target.name;
                            
                            console.log('\n'+id_all_recipe+'\n');
                
                        });


                
                        items.push('<h1>' + val.title + '</h1>');
                        text += '<div id="recipe'+val.recipe_id+'" class="recipe">'+'<div class="ing"><h1>' + val.title + '</h1><form class="ing" method="post">+<input type="hidden" name="id_recipe" value="'+val.recipe_id+'"><button type="submit">Ajouter la recette</button></form></div><div class="container"><img src="'+val.image_name+'" alt="serving image"><h2>Instructions</h2><p>'+val.instructions+'</p><h2>Ingredients</h2><ul>';
                        $.each(val.ingredients, function (key, val2){
                            text+= '<form class="ing" method="post" name="ingredient"><li>'+val2.department+' '+val2.quantity + '' +val2.unit +' of '+val2.name+'</li><input type="hidden" name="id_ingredient" value="'+val2.display_index+'"><input type="hidden" name="id_recipe" value="'+val.recipe_id+'"><button type="submit">Ajouter l\'ingredient</button></form>';

                        });
                        text+='</ul></div></div>';
                        // console.log(val);
                    });
    
                    text += '</div>';

                    $('body').append(text);
    
                },
                statusCode: {
                    404: function () {
                        alert('There was a problem with the server.  Try again soon!');
                    }
                }
            });

        });
    });
}( jQuery ));
