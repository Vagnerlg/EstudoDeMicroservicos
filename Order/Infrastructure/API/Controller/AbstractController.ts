import { Context } from "koa";

export default abstract class AbstractController
{
    response(ctx: Context, data: object): void
    {
        ctx.body = {data}    
    }

    responseNotFound(ctx: Context, type: string): void
    {
        ctx.status = 404
        ctx.body = {
            'error': [
                {[type]: type + ' not found'}
            ]
        }
    }
}