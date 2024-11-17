const { TorusKnotGeometry } = require("three");

function SaveEF(id){
    let gen_rec=parseFloat(document.getElementById('gen_recyclable_weight').value);
    let rec_rec=parseFloat(document.getElementById('rec_recyclable_weight').value);
    let gen_food=parseFloat(document.getElementById('gen_food_waste_weight').value);
    let rec_food=parseFloat(document.getElementById('rec_food_waste_weight').value);
    let gen_gen=parseFloat(document.getElementById('gen_general_waste_weight').value);
    let rec_gen=parseFloat(document.getElementById('rec_general_waste_weight').value);
    let gen_haz=parseFloat(document.getElementById('gen_hazardous_weight').value);
    let rec_haz=parseFloat(document.getElementById('rec_hazardous_weight').value);
    let date=document.getElementById('collection_date').value;
    
    axios.post('/api/SaveEF',{
        'id':id,
        'gen_recyclable_weight':gen_rec,
        'rec_recyclable_weight':rec_rec,
        'gen_food_waste_weight':gen_food,
        'rec_food_waste_weight':rec_food,
        'gen_general_waste_weight':gen_gen,
        'rec_general_waste_weight':rec_gen,
        'gen_hazardous_weight':gen_haz,
        'rec_hazardous_weight':rec_haz,
        'collection_date':date
    },{
        headers:{
            'X-CSRF-TOKEN':document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        }
    })
    .then(res=>{
        alert('儲存成功');
        document.getElementById('cls').click();
        document.getElementById(`EFbtn-${id}`).setAttribute('onclick',`EditEF(${id})`);
        document.getElementById(`EFbtn-${id}`).textContent="更改";
    })
    .catch(err=>{
        console.log('err',err);
    })
}

function EditEF(id){
    let gen_rec=parseFloat(document.getElementById('gen_recyclable_weight').value);
    let rec_rec=parseFloat(document.getElementById('rec_recyclable_weight').value);
    let gen_food=parseFloat(document.getElementById('gen_food_waste_weight').value);
    let rec_food=parseFloat(document.getElementById('rec_food_waste_weight').value);
    let gen_gen=parseFloat(document.getElementById('gen_general_waste_weight').value);
    let rec_gen=parseFloat(document.getElementById('rec_general_waste_weight').value);
    let gen_haz=parseFloat(document.getElementById('gen_hazardous_weight').value);
    let rec_haz=parseFloat(document.getElementById('rec_hazardous_weight').value);
    let date=document.getElementById('collection_date').value;
    
    axios.put(`/api/EditEF/${id}`,{
        'id':id,
        'gen_recyclable_weight':gen_rec,
        'rec_recyclable_weight':rec_rec,
        'gen_food_waste_weight':gen_food,
        'rec_food_waste_weight':rec_food,
        'gen_general_waste_weight':gen_gen,
        'rec_general_waste_weight':rec_gen,
        'gen_hazardous_weight':gen_haz,
        'rec_hazardous_weight':rec_haz,
        'collection_date':date
    },{
        headers:{
            'X-CSRF-TOKEN':document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        }
    })
    .then(res=>{
        alert('變更成功');
        document.getElementById('cls').click();
    })
    .catch(err=>{
        console.log('err',err);
    })
}