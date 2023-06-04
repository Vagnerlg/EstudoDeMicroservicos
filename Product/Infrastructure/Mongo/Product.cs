using MongoDB.Bson;
using MongoDB.Bson.Serialization.Attributes;

namespace Mongo;

public class Product
{
    [BsonId]
    [BsonRepresentation(BsonType.ObjectId)]
    public string? Id { get; set; }
    public string Nome { get; set; }
    
    public string Description { get; set; }
    
    public List<string> Ingredients { get; set; }

    public Product(string nome, string description, List<string> ingredients)
    {
        Nome = nome;
        Description = description;
        Ingredients = ingredients;
    }
}