using MongoDB.Bson;
using MongoDB.Driver;

namespace Mongo;

public class Repository: Database
{
    private  IMongoCollection<Product> Collection { get; }
    
    public Repository()
    { 
        Collection = DB.GetCollection<Product>("product");
    }

    public IEnumerable<Product> All()
    {
        return Collection.Find(_ => true).ToList();
    }

    public void Insert(Product product)
    {
        Collection.InsertOne(product);
    }

    public Product FindById(string id)
    {
        var filter = Builders<Product>.Filter.Eq(p => p.Id, id);

        return Collection.Find(filter).First();
    }
}