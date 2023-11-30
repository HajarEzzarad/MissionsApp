
<x-app-layout>
<style>
.selected {
    background-color: #e2e8f0; 
}
.chat-container{
    height: 460px;
    display: flex;
    flex-direction: column;
    overflow-y: scroll;

}
.chat-container::-webkit-scrollbar {
    width: 0; 
}


.chat-container::-webkit-scrollbar-track {
    background-color: transparent; 
}

.chat-container::-webkit-scrollbar-thumb {
    background-color: transparent;  
}
#sendMsg{
    margin-top: auto;
    padding: 10px;
    width: 100%;
    box-sizing: border-box;
    justify-content: center;
}

</style>
  <div>
    <div class="container mx-autos bg-white w-screen">
      <div class="min-w-full border rounded lg:grid lg:grid-cols-3">

        <div class=" border-r border-gray-300 lg:col-span-1">
         <div x-data="{ activeTab: 'chats' }">

  <div class="flex justify-center items-center">
  <button @click="activeTab = 'chats'" :class="{ 'border-b-2 border-purple-500': activeTab === 'chats', 'text-gray-500': activeTab !== 'chats' }" class="px-4 py-2 mx-1 focus:outline-none">Chats</button>
  <button @click="activeTab = 'managers'" :class="{ 'border-b-2 border-purple-500': activeTab === 'managers', 'text-gray-500': activeTab !== 'managers' }" class="px-4 py-2 mx-1 focus:outline-none">Managers</button>
  <button @click="activeTab = 'clients'" :class="{ 'border-b-2 border-purple-500': activeTab === 'clients', 'text-gray-500': activeTab !== 'clients' }" class="px-4 py-2 mx-1 focus:outline-none">Clients</button>
    
  </div>

  <!-- Tab content -->
  <div x-show="activeTab === 'chats'" class="chat-section">
   
    <ul id="chats" class="chat-container">
   
    </ul>
  </div>
  <div x-show="activeTab === 'managers'" class="managers-section">
    
    <ul class="chat-container">
      <!-- Display manager users here -->
      @foreach($managers as $d)
      <li >
        <a data-manager-id="{{ $d->id }}" data-manager-role="{{$d->getChatType()}}" data-manager-nom="{{ $d['nom'] }}" data-manager-prenom="{{ $d['prenom'] }}" class="manager-item flex items-center px-3 py-2 text-sm transition duration-150 ease-in-out border-b border-gray-300 cursor-pointer hover:bg-gray-100 focus:outline-none">
          <img class="object-cover w-10 h-10 rounded-full" src="https://cdn.pixabay.com/photo/2018/09/12/12/14/man-3672010__340.jpg" alt="username" />
          <div class="w-full pb-2">
            <div class="flex justify-between">
              <span class="block ml-2 font-semibold text-black-600"> {{ $d['nom'] }} {{ $d['prenom'] }}</span>
             
            </div>
          </div>
        </a>
      </li>
    @endforeach
    </ul>
  </div>

  <div x-show="activeTab === 'clients'" class="clients-section">
 
    <ul class="chat-container">
      <!-- Display client users here -->
      @foreach($clients as $d)
      <li>
        <a data-manager-id="{{ $d->id }}" data-manager-role="{{$d->getChatType()}}" class="manager-item flex items-center px-3 py-2 text-sm transition duration-150 ease-in-out border-b border-gray-300 cursor-pointer hover:bg-gray-100 focus:outline-none">
          <img class="object-cover w-10 h-10 rounded-full" src="https://cdn.pixabay.com/photo/2018/09/12/12/14/man-3672010__340.jpg" alt="username" />
          <div class="w-full pb-2">
            <div class="flex justify-between">
              <span class="block ml-2 font-semibold text-black-600"> {{ $d['nom'] }} {{ $d['prenom'] }}</span>
   
            </div>
          </div>
        </a>
      </li>
    @endforeach
    </ul>
  </div>
</div>

  
    

        </div>
        <div class="hidden lg:col-span-2 lg:block">
          <div class="w-full">
            <!--chat between manager and admin-->
            <div id="chat" class="container mx-auto p-4">
    <div id="name_sender"class="text-2xl font-bold mb-4"></div>
    
<div >
    <div id="messages" class="chat-container"></div>

    <div id="sendMsg">
        <input type="text" id="msgTxt" placeholder="Type your message ..." class="w-5/6 py-2 pl-4 mx-3 bg-white-100 rounded-full outline-none focus:text-gray-700">
        <button id="msgBtn" value="send" type="submit" onclick="module.sendMsg()" class="p-2 bg-purple-500 text-white">Send</button>
    </div>
</div>
                </div>

          </div>
        </div>
      </div>
    </div>
    
<script>
    module = {};
</script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script type="module" src="https://www.gstatic.com/firebasejs/9.15.0/firebase-app.js"></script>
<script type="module" src="https://www.gstatic.com/firebasejs/9.15.0/firebase-database.js"></script>

<script type="module">
   import { initializeApp } from "https://www.gstatic.com/firebasejs/9.15.0/firebase-app.js";
import { getDatabase, ref, set, remove, onChildAdded, onChildRemoved ,query, orderByChild, equalTo} from "https://www.gstatic.com/firebasejs/9.15.0/firebase-database.js";



    const firebaseConfig = {
      apiKey: "AIzaSyAehxQi2ll_DDEcheQTpXFVlj8FXHTHsKE",
      authDomain: "test-chat-71d55.firebaseapp.com",
      databaseURL: "https://test-chat-71d55-default-rtdb.firebaseio.com",
      projectId: "test-chat-71d55",
      storageBucket: "test-chat-71d55.appspot.com",
      messagingSenderId: "219141915987",
      appId: "1:219141915987:web:d8325073970c0f30d7cda6",
      measurementId: "G-RRXEL7F27D"
    };

    const app = initializeApp(firebaseConfig);
    const db = getDatabase(app);

//get the chatted users here 


// Your function to fetch unique members
function fetchUniqueMembers(adminId, adminRole) {
    const chatRef = ref(db, 'chat/');
    const uniqueMembers = [];

    onChildAdded(chatRef, (snapshot) => {
        const message = snapshot.val();

        if (message.Senderid === adminId && message.Senderole === adminRole) {
            const uniqueMember = {
                id: Number(message.recieverId),
                role: message.recieverRol,
            };

            if (!uniqueMembers.some((member) => member.id === uniqueMember.id && member.role === uniqueMember.role)) {
                uniqueMembers.push(uniqueMember);
            }
        } else if (message.recieverId === adminId && message.recieverRol === adminRole) {
           const uniqueMember = {
                id: Number(message.Senderid),
                role: message.Senderole,
            };

            if (!uniqueMembers.some((member) => member.id === uniqueMember.id && member.role === uniqueMember.role)) {
                uniqueMembers.push(uniqueMember);
            }
        }

    });

    return uniqueMembers;
}

const adminId = "{{ auth()->user()->id }}";
const adminRole = "Admin";
const uniqueMembers = fetchUniqueMembers(adminId, adminRole);
console.log(uniqueMembers);


 fetch(`/get-chatted-users`)
    .then(response => response.json())
    .then(data => {
      const chattedUsers = Array.isArray(data.chattedUsers) ? data.chattedUsers : [];
      
      console.log('chatted users:', chattedUsers);
    
     
    const fetchUsers = uniqueMembers.filter(user => {

        return user.role === 'manager';
    });


 console.log('fetched users:',fetchUsers);




const chatsContainer = document.getElementById('chats');


fetchUsers.forEach(user => {
                const userContainer = document.createElement('a');
                userContainer.setAttribute('data-manager-id', user.id);
                userContainer.setAttribute('data-manager-role', user.role);
                userContainer.classList.add('manager-item', 'flex', 'items-center', 'px-3', 'py-2', 'text-sm', 'transition', 'duration-150', 'ease-in-out', 'border-b', 'border-gray-300', 'cursor-pointer', 'hover:bg-gray-100', 'focus:outline-none');
                userContainer.innerHTML = `
                    <img class="object-cover w-10 h-10 rounded-full" src="https://cdn.pixabay.com/photo/2018/09/12/12/14/man-3672010__340.jpg" alt="username" />
                    <div class="w-full pb-2">
                        <div class="flex justify-between">
                            <span class="block ml-2 font-semibold text-black-600">${user.name} (${user.role})</span>
                            <span class="block ml-2 text-sm text-black-600">25 minutes</span>
                        </div>
                        <span class="block ml-2 text-sm text-black-600" id="lastMsg_${user.id}"></span>
                    </div>
                `;

                chatsContainer.appendChild(userContainer);
            });
          })
        .catch(error => console.error('Error fetching chatted users:', error));
   






  // Add a click event listener to each manager item
document.querySelectorAll('.manager-item').forEach(function (managerItem) {
        managerItem.addEventListener('click', function () {
            const managerId = this.getAttribute('data-manager-id');
            const managerRole = this.getAttribute('data-manager-role');
            const managerNom = this.getAttribute('data-manager-nom');
            const managerPrenom = this.getAttribute('data-manager-prenom');
            document.querySelectorAll('.manager-item').forEach(function (item) {
            item.classList.remove('selected');
        });
        this.classList.add('selected');

            // Update the chat window based on the selected manager
            updateChat(managerId,managerRole);
          
        });
    });   
   





// Function to clear existing messages
function clearMessages() {
    name_sender.innerHTML = '';
    messages.innerHTML = '';
}


function updateChat(managerId,managerRole) {
  clearMessages();
    // variables
    var msgTxt = document.getElementById('msgTxt');
    const senderName = "{{ auth()->user()->name }}";
    const senderId = "{{ auth()->user()->id }}";

    // TO SEND MESSAGES
    module.sendMsg = function sendMsg() {
        var msg = msgTxt.value;
        var timestamp = new Date().toLocaleTimeString();
        set(ref(db, "chat/" + timestamp), {
            text: msg,
            Senderid: senderId,
            Senderole : 'Admin',
            read : false,
            recieverId: managerId,
            recieverRol: managerRole,
            timestamp : timestamp,

        })

        msgTxt.value = "";
    }

    // Display messages for Admin to-manager or to-client chat
    onChildAdded(ref(db, "chat/"), (data) => {
        if (data.val().Senderid == senderId && data.val().recieverId == managerId && data.val().recieverRol == managerRole) {
          
          messages.innerHTML += `<li class="flex justify-end"><div class="relative max-w-xl px-4 py-2 text-white-700 bg-purple-500 rounded-full shadow m-1"><span class="block" id=${data.key}>${data.val().text}</span><span class="text-sm text-white-500">${data.val().timestamp}</span></div></li>`;

        }
    });

    // Display messages 
      onChildAdded(ref(db, "chat/"), (data) => {
        if (data.val().Senderid == managerId && data.val().recieverId == senderId && data.val().recieverRol == 'Admin' && data.val().Senderole == managerRole) {
      
          messages.innerHTML += `<li class="flex justify-start"><div class="relative max-w-xl px-4 py-2 text-white-700 bg-gray-500 rounded-full shadow m-1"><span class="block" id=${data.key}>${data.val().text}</span><span class="text-sm text-white-500">${data.val().timestamp}</span></div></li>`;
        }
    });

  }
 

 
    // TO DELETE MSG
    module.dltMsg = function dltMsg(key){
        remove(ref(db,"chat/"+key));
    }

    // WHEN MSG IS DELETED
    onChildRemoved(ref(db,"chat/"),(data)=>{
        var msgBox = document.getElementById(data.key);
        messages.removeChild(msgBox);
    })
</script>



    </x-app-layout>