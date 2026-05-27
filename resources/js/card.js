import Card from './components/Card';
import RangedCard from './components/RangedCard';

Nova.booting(Vue => {
    Vue.component('versioon-html-card', Card);
    Vue.component('versioon-html-ranged-card', RangedCard);
});
