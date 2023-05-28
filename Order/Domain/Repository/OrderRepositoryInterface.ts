import Order from "../Order";

export default interface OrderRepositoryInterface
{
    findById(id: string): Promise<Order | null>
    findByUserId(id: string): Promise<Order | null>
    addItem(userId: string, item: Item): Promise<boolean>
}