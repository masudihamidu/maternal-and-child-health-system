<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Mothers with Disease Today Data
        var mothersWithDiseaseToday = @json("mothersDesease");

        var diseaseDates = mothersWithDiseaseToday.map(function(item) {
            return item.date;
        });
        var mothersWithDiseaseCount = mothersWithDiseaseToday.map(function(item) {
            return item.countMotherWITHdisease;
        });

        // Generate Bar Chart for Mothers with Disease Today
        c3.generate({
            bindto: '#barChart',
            data: {
                x: 'x',
                columns: [
                    ['x'].concat(diseaseDates),
                    ['Mothers with Disease'].concat(mothersWithDiseaseCount)
                ],
                colors: {
                    'Mothers with Disease': '#006DF0'
                },
                type: 'bar'
            },
            axis: {
                x: {
                    type: 'category'
                }
            }
        });

        // Mothers with Immunity Today Data
        var mothersWithImmunityToday = @json("mothersImmunity");

        var immunityDates = mothersWithImmunityToday.map(function(item) {
            return item.date;
        });
        var mothersWithImmunityCount = mothersWithImmunityToday.map(function(item) {
            return item.countMotherWITHimmunity;
        });

        // Generate Line Chart for Mothers with Immunity Today
        c3.generate({
            bindto: '#lineChart',
            data: {
                x: 'x',
                columns: [
                    ['x'].concat(immunityDates),
                    ['Mothers with Immunity'].concat(mothersWithImmunityCount)
                ],
                colors: {
                    'Mothers with Immunity': '#933EC5'
                },
                type: 'line'
            },
            axis: {
                x: {
                    type: 'category'
                }
            }
        });
    });
</script>
