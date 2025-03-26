$(document).ready(() => {
   $.ajax({
      url: "/api/tasks"
   }).done(res => {
      let htm = ''
      
      for(let tarefa of res){
         let classeStatus = ''
         switch(tarefa.status){
            case 'Pendente':
               classeStatus = 'statusPendente';
               break;
            case 'Em Andamento':
               classeStatus = 'statusEmAndamento';
               break;
            case 'Concluída':
               classeStatus = 'statusConcluida';
               break;
         }

         htm += `
         <div class="card mx-auto w-100 ${classeStatus}" style="max-width: 600px;">
            <div class="gap-3 gap-md-0 row">
               <div class="col-12 col-md-8 d-flex flex-column">
                  <h2 class="fw-bold mb-1" style="font-size: 24px">${tarefa.title}</h2>
                  <h3 style="font-size: 16px">${tarefa.description}</h3>
               </div>
   
               <div class="align-items-center col-12 col-md-4 d-flex flex-column gap-2 justify-content-between">
                  <p title="Status">
                     <i class="bi bi-hourglass-split me-1" style="font-size: 18px"></i> ${tarefa.status}
                  </p>
   
                  <p title="Criado em">
                     <i class="bi bi-calendar-event me-1" style="font-size: 18px"></i> ${formatarData(tarefa.created_at)}
                  </p>
   
                  <div class="align-items-center d-flex gap-3 justify-content-between">
                     <button class="bg-transparent" title="Editar" type="button">
                        <a href="/editar?id=${tarefa.id}">
                           <i class="bi bi-pencil-square" style="font-size: 22px"></i>
                        </a>
                     </button>
                     
                     <button class="bg-transparent" title="Excluir" onclick="excluirTarefa('${tarefa.id}')" type="button">
                        <i class="bi bi-trash" style="font-size: 22px"></i>
                     </button>
                  </div>
               </div>
            </div>
         </div>`
      }

      if(res.length == 0){
         htm = '<p>Nenhuma tarefa encontrada.</p>'
      }

      $('#listaTarefas').html(htm)
   })
})

function excluirTarefa(id){
   Swal.fire({
      title: "Deseja mesmo excluir esta tarefa?",
      confirmButtonText: 'Sim',
      confirmButtonColor: 'green',
      denyButtonText: 'Não',
      showDenyButton: true
   }).then(res => {
      if (res.isConfirmed) {
         $.ajax({
            url: "/api/tasks/" + id,
            method: 'DELETE'
         }).done(() => {
            window.location.reload()
         })
      }
   })
}

function formatarData(data){
   const partesData = data.split('-')

   return `${partesData[2]}/${partesData[1]}/${partesData[0]}`
}