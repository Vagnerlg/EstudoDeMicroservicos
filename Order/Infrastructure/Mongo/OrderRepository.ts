import { Collection, ObjectId } from "mongodb";
import Order from "../../Domain/Order";
import OrderRepositoryInterface from "../../Domain/Repository/OrderRepositoryInterface";
import Client from "./Client";

export default class OrderRepository implements OrderRepositoryInterface
{
    private collerction: Collection<Order>
    private client: Client

    constructor()
    {
        this.client = new Client()
        this.collerction = this.client.getDb().collection<Order>('order')
    }

    async findById(id: string): Promise<Order | null> {
        const result = await this.collerction.findOne({
            '_id': new ObjectId(id)
        }).then(
            value => value
        )

        return result
    }

    async findByUserId(id: string): Promise<Order | null> {
        const result = await this.collerction.findOne({
            'userId': id
        }).then(
            value => value
        )

        return result
    }

    async addItem(userId: string, item: Item): Promise<boolean> {
        return await this.findByUserId(userId).then(order => {
            if (!order) {
                return this.collerction.insertOne(new Order(
                    userId,
                    'progess',
                    [item]
                )).then(value => value.acknowledged)
            }

            order.items?.push(item)

            return this.collerction.updateOne({
                'userId': userId,
            }, order).then(value => value.acknowledged)
        })
    }
}