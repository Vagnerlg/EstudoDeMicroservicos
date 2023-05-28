import { Context } from "koa"
import OrderRepository from "../../Mongo/OrderRepository"
import AbstractController from "./AbstractController"


export default class OrderController extends AbstractController
{

    private repository: OrderRepository

    constructor()
    {
        super()
        this.repository = new OrderRepository()
    }

    async getByUserId(ctx: Context): Promise<void>
    {
        
        const result = await this.repository.findByUserId(ctx.params.userId)
        if (!result) {
            this.responseNotFound(ctx, 'order')
        } else {
            this.response(ctx, result)
        }
    }
}