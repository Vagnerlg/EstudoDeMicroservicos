using Mongo;
using MongoDB.Bson;

Console.WriteLine("Inicio");

var ingredients = new List<string>();
ingredients.Add("Mussarela");
ingredients.Add("Frango");
var product = new Product("Vagner", "Luiz Gonçalves", ingredients);

var repo = new Repository();
var product2 = repo.FindById("644d977825182779e9d9d70d");

Console.WriteLine(product2.ToJson());