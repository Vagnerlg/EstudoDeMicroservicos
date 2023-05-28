import { Context } from "koa"
import Router, { IMiddleware } from "koa-router"
import OrderController from "./OrderController"

export default function router(): IMiddleware<any, {}>
{
    const router: Router = new Router()
    const controller = new OrderController()
    router.get('/order/:userId', async (ctx: Context) => await controller.getByUserId(ctx))

    return router.routes()
}