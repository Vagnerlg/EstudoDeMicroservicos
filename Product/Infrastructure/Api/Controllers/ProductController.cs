using Microsoft.AspNetCore.Mvc;
using Mongo;

namespace Api.Controllers;

[ApiController]
[Route("product")]
public class ProductController : ControllerBase
{
    [HttpGet]
    public IActionResult All()
    {
        var repo = new Repository();
        var products = repo.All();
        return Ok(products);
    }
}