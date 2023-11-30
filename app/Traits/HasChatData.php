

namespace App\Traits;

trait HasChatData
{
    public function getChatData()
    {
        return [
            'id' => $this->id,
            'nom' => $this->nom, 
            'prenom' => $this->prenom,
            'type' => $this->getChatType(),
        ];
    }

    abstract protected function getChatType();
}
