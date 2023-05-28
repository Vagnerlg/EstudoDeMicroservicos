import { ObjectId } from "mongodb";

export default class Order{

    public id?: ObjectId

    constructor(
        public userId: string,
        public status: 'progess',
        public items?: Item[],
    ) {}
}