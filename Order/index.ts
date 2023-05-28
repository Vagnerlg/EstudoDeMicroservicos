import OrderRepository from './Infrastructure/Mongo/OrderRepository';

(new OrderRepository()).findByUserId('645fe4f05bad63aa8318ae45').then(value => console.log(value))