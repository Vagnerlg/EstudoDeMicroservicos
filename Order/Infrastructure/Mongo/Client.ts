import { MongoClient, Db } from "mongodb";

export default class Client
{
    private database?: Db

    constructor(
        private client = new MongoClient(process.env.MONGO_URI ?? '')
    )
    {}

    public getDb(): Db
    {
        if (!this.database){
            this.database = this.client.db(process.env.MONGO_DB)
        }
        
        return this.database
    }

    public close(): void
    {
        this.client.close()
    }
}