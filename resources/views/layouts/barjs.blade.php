<script>
        document.addEventListener('DOMContentLoaded', function () {
            const dailyRegistrations = @json($dailyRegistrations);

            const dates = ['x'];
            const counts = ['Registrations'];

            dailyRegistrations.forEach(item => {
                dates.push(item.date);
                counts.push(item.count);
            });

            c3.generate({
                bindto: '#stocked',
                data: {
                    x: 'x',
                    columns: [
                        dates,
                        counts
                    ],
                    colors: {
                        Registrations: '#006DF0'
                    },
                    type: 'bar'
                },
                axis: {
                    x: {
                        type: 'timeseries',
                        tick: {
                            format: '%Y-%m-%d'
                        }
                    }
                }
            });
        });
    </script>
