// function get_no_of_group(e) {
//     if($('#booked_seat').val()){
//       $('#team_size').val(parseInt($('#booked_seat').val()));
//     }else{
//       $('#team_size').val('');
//     }
// }
function get_no_of_days(e) {
    if($('#nights').val()){
        $('#days').val(parseInt($('#nights').val()) +1 );
    }else{
        $('#days').val('');
    }
}
    $('#meal_plan').select2({
      placeholder: 'Select Meals Plan',
    });
    $('#transport_type').select2({
      placeholder: 'Select Transport Type',
    });
    $('#tags').select2({
        placeholder: 'Add Tag(s)',
        tags: true,
    })
    // $('.itinerary').select2({
    //         placeholder: 'Select Itinerary',
    //         ajax: {
    //             url: "/agent-itinerary-ajax",
    //             dataType: 'json',
    //             delay: 250,
    //             processResults: function (data) {
    //                 return {
    //                     results: $.map(data, function (item) {
    //                         return {
    //                             text: item.title,
    //                             id: item.id
    //                         }
    //                     })
    //                 };
    //             },
    //             cache: true
    //         }
    //     });
// Ajax Destination Search from pullit

    $(document).ready(function(){
        $('.destinations').on('keyup', function(){
            var text = $('.destinations').val();
            if(text.length > 1){
                $.ajax({
                  type:"post",
                  url: 'http://api.tutterflycrm.com/ptprog/api/get_destination_name_for_watfd',
                  data: {text: $('.destinations').val()},
                  success: function(data) {
                    console.log(data);
                    if(data && data.destination.length>0){
                        fetch_from_pullit(data);  
                    }
                   }
                });
           }else{
                $(".autocomplete-items").css('display','none');
           }          
        });
      });
    function fetch_from_pullit(data){
        $(".autocomplete-items").css('display','block');
                          var html="";
                          html+="<ul class='search-list'>";                
                           let k=0;
                          for(dest of data.destination){
                              if(k<10){
                                 var dest_id=dest.id;

                                var dest_name=dest.dest_name;
                                var dest_names = dest_name.replace(/'/,''); 

                                var region=dest.region;
                                var regions = region.replace(/'/,'');

                                var countryname=dest.country_name;
                                var country_names = countryname.replace(/'/,'');  

                                var countryid = dest.count_id;

                                var actual_name=dest.actualname;
                                if(actual_name){
                                  var actual_names = actual_name.replace(/'/,''); 
                                }

                                var iso2=dest.country_iso_2;
                                var iso2s = iso2.replace(/'/,'');

                                var iso3=dest.country_iso_3;
                                var iso3s = iso3.replace(/'/,''); 

                                var descriptions = JSON.stringify(dest.description);
                                if(descriptions){
                                  var descriptionz = descriptions.replace(/["']+/g, '',/'/);
                                }

                                var official_names=dest.official_name;
                                if(official_names){
                                    var official_name = official_names.replace(/'/,''); 
                                } 
                                else{
                                    var official_name = '';
                                }

                                var capitals=dest.capital;
                                if(capitals){
                                var capital = capitals.replace(/'/,'');  
                                }
                                else{
                                var capital = '';
                                }
                                var largest_citys=dest.largest_city;
                                if(largest_citys){
                                var largest_city = largest_citys.replace(/'/,'');  
                                }else{
                                var largest_city = '';
                                }
                                var continents=dest.continent;
                                if(continents){
                                var continent = continents.replace(/'/,'');
                                }else{
                                var continent = '';
                                }
                                var count_dess = JSON.stringify(dest.count_des);
                                if(count_dess){
                                 var count_des = count_dess.replace(/["']+/g, '',/'/);
                                } 
                                else{
                                var count_des = '';
                                }

                                var sub_continents=dest.sub_continent;
                                if(sub_continents){
                                var sub_continent = sub_continents.replace(/'/,''); 
                                } 
                                else{
                                var sub_continent = '';
                                } 

                                var iso_2s=dest.iso_2;
                                var iso_2 = iso_2s.replace(/'/,'');  

                                var iso_3s=dest.iso_3;
                                var iso_3 = iso_3s.replace(/'/,'');

                                var isd_codes=dest.isd_code;
                                if(isd_codes){
                                var isd_code = isd_codes.replace(/'/,'');  
                                } 
                                else{
                                var isd_code = '';
                                } 
                                var count_lats=dest.count_lat; 

                                var count_longs=dest.count_long;  

                                var internet_tlds=dest.internet_tld;
                                if(internet_tlds){
                                var internet_tld = internet_tlds.replace(/'/,'');
                                }else{
                                var internet_tld = '';
                                }
                                var currencys=dest.currency;
                                if(currencys){
                                var currency = currencys.replace(/'/,'');
                                }else{
                                var currency = '';
                                }  

                                var currency_symbols=dest.currency_symbol;
                                if(currency_symbols){
                                var currency_symbol = currency_symbols.replace(/'/,''); 
                                }else{
                                var currency_symbol = '';
                                } 

                                var currency_codes=dest.currency_code;
                                if(currency_codes){
                                var currency_code = currency_codes.replace(/'/,'');  
                                }else{
                                var currency_code = '';
                                } 

                                var drives_ons=dest.drives_on;
                                if(drives_ons){
                                var drives_on = drives_ons.replace(/'/,'');
                                }else{
                                var drives_on = '';
                                } 

                                var areas=dest.area;
                                if(areas){
                                var area = areas.replace(/'/,''); 
                                }else{
                                var area = '';
                                } 

                                var area_units=dest.area_unit;
                                if(area_units){
                                var area_unit = area_units.replace(/'/,'');
                                }else{
                                var area_unit = '';
                                }

                                var populations=dest.population;
                                if(populations){
                                var population = populations.replace(/'/,''); 
                                }else{
                                var population = '';
                                } 
                                 var add = dest_names +'('+country_names+')';
                                 html+="<li onclick='initDestination("+dest.latitude+","+dest.longitude+",&quot;"+dest_names+"&quot;,&quot;"+country_names+"&quot;,&quot;"+actual_names+"&quot;,&quot;"+regions+"&quot;,&quot;"+iso2s+"&quot;,&quot;"+iso3s+"&quot;,&quot;"+descriptionz+"&quot;,"+dest.id+","+count_lats+","+count_longs+",&quot;"+official_name+"&quot;,&quot;"+capital+"&quot;,&quot;"+largest_city+"&quot;,&quot;"+continent+"&quot;,&quot;"+count_des+"&quot;,&quot;"+sub_continent+"&quot;,&quot;"+iso_2+"&quot;,&quot;"+iso_3+"&quot;,&quot;"+isd_code+"&quot;,&quot;"+internet_tld+"&quot;,&quot;"+currency+"&quot;,"+countryid+",&quot;"+currency_symbol+"&quot;,&quot;"+currency_code+"&quot;,&quot;"+drives_on+"&quot;,&quot;"+area+"&quot;,&quot;"+area_unit+"&quot;,&quot;"+population+"&quot;)'><i style='margin-right:5px; color:#A9A9A9' class='fas fa-map-marker-alt'></i> <b style='color:#222'>"+dest.dest_name+' ('+regions+')'+' ('+country_names+')'+"</b></li>";
                              }                                  
                              k++;
                          }
                          html+="</ul>";                  
                         $(".autocomplete-items").html(html);
          }

          var dest_selected=[];
    function initDestination(Lat, Long, dest_name, country, actual_names, regions, iso2s, iso3s, descriptionz, destId, countLat, countLong, officeName, capital, largeCity, continent, countDesc, subCountinent, countIso2, countIso3, isdCode, internetTld, currency, cointryId, currencySymbol, currencyCode, driveOn, area, areaUnit, population) {

        dest_selected.push(
            {
              'name':dest_name,
              'actual_name':actual_names,
              'country':country,
              'id':destId,
              'lat':Lat,
              'long':Long,
              'region':regions,
              'iso2':iso2s,
              'iso3':iso3s,
              'description':descriptionz,
              'country_id':cointryId,
              'country_lat':countLat,
              'country_long':countLong,
              'official_name':officeName,
              'capital':capital,
              'largest_city':largeCity,
              'continent':continent,
              'sub_continent':subCountinent,
              'count_description':countDesc,
              'count_iso2':countIso2,
              'count_iso3':countIso3,
              'isd_code':isdCode,
              'internet_tld':internetTld,
              'currency':currency,
              'currency_symbol':currencySymbol,
              'currency_code':currencyCode,
              'drive_on':driveOn,
              'area':area,
              'area_unit':areaUnit,
              'population':population,
            }
        );
        $(".autocomplete-items").css('display','none');
        $(".destinations").val('');
        $('#destinationName').val(JSON.stringify(dest_selected));
        console.log(dest_selected);
        set_dest_html();     
    }

    function remove_des(i){
        console.log(dest_selected[i]);
        dest_selected.splice(i,1);
        set_dest_html();
    }

   function set_dest_html(){
        var dest_html='';
        if(dest_selected.length>0){
            var i=0;
            for(var des of dest_selected){
                dest_html+='<span class="badge badge-pill badge-primary dest_badge">'+des.name+'  <i class="fa fa-times" onclick="remove_des('+i+')"></i></span>';
                i++;

            }
            $("#dropdest").html(dest_html);
            $('#destinationName').val(JSON.stringify(dest_selected));
        }else{
             $("#dropdest").html('');
             $('#destinationName').val(JSON.stringify(dest_selected));
        }
    }

    

  
