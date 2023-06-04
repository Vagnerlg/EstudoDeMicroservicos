using MongoDB.Driver;

namespace Mongo;

public class Database
{
    protected IMongoDatabase DB { get; }

    public Database()
    {
        DB = new MongoClient("mongodb://root:example@localhost:27017/").GetDatabase("mongodotnet");
    }
}