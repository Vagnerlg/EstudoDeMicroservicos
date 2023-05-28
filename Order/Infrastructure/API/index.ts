import Koa, { Context } from 'koa'
import Router from 'koa-router'
import * as dotenv from 'dotenv'
import OrderController from './Controller/OrderController'
import router from './Controller/router'
dotenv.config()

const app: Koa = new Koa()

app.use(router())

app.listen(3000, () => console.log(process.env))