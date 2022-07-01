const ul = document.querySelector("#tag-box");
input = ul.querySelector("input");
key = document.getElementById('key');
let tags;
if(key.value == ""){
    tags =[];
}
else
{
    tags = key.value.split(", ");
    createTag();
}

function createTag(){
    ul.querySelectorAll("li").forEach(li => li.remove());
    tags.slice().reverse().forEach(tag => {
        let liTag = ` <li> ${tag} <span onclick="remove(this,'${tag}')">x</span></li>`;
        ul.insertAdjacentHTML("afterbegin",liTag);
    });
}
function remove(element, tag)
{  
    let index = tags.indexOf(tag);
    tags = [...tags.slice(0,index),...tags.slice(index + 1)];
    element.parentElement.remove();
    if(index == 0)
    {
        if(key.value.split(",").length == 1)
            key.value = key.value.replace(`${tag}`,'');
        else
            key.value = key.value.replace(`${tag}, `,'');
    }
    else
    key.value = key.value.replace(`, ${tag}`,'');

}
$("*").click(function(){
    $("#listkey").removeClass("block");
});
function addTag(e)
{
    if(e.key == "Enter")
    {
        let tag = e.target.value.replace(/\s+/g,' ');
        if(tag.length >1 && !tags.includes(tag)){
            tag.split(',').forEach(tag=>{
                tags.push(tag);
                createTag();
                if(key.value == "")
                    key.value += `${tag}`;
                else
                    key.value += `, ${tag}`;
            })
            input.value ="";
    }
    }
   
}
input.addEventListener("keyup",addTag);

