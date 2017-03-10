# Mithrandir Firewall
![Logo](img/Logo.png)

# Objetivo
O firewall é uma parte fundamental de uma rede, sua função é monitorar o tráfego de rede de entrada e saída e decidir permitir ou bloquear esse tráfego de acordo com um conjunto de regras de segurança pré-definidas. Porém, essa função depende de um constante gerenciamento para atualizar ou criar novas regras afim de evitar brechas e falhas de segurança.  Com isso o trabalho proposto visa fornecer uma aplicação web de fácil utilização para otimizar a configuração e gerenciamento de um firewall.

# Ideia principal
A ideia principal é desenvolver uma aplicação web de gerenciamento de um firewall com as seguintes características:
- Definição de regras de acesso
- Controle de endereço IP
- Controle de Portas e Protocolos de comunicação
- Controle de programas
- Contra ataque (Beta)

# Mockups
- Sistema
![sys](img/Sistema.png)


- Status
![stt](img/Status.png)


- Configurar
![conf1](img/Configurar1.png)
![conf2](img/Configurar2.png)

# Comandos do Firewall
Alguns comandos que poderão ser usados na configuração do serviço do firewall compreendem principalmente o iptables: ``iptables [comandos] [parametros] [extensoes]``

### Alguns [comandos]
* -A: Adiciona uma nova regra
  * INPUT: Sinaliza que é para um pacote que está chegando na máquina;
  * OUTPUT: Sinaliza que é para um pacote que está saindo de máquina;
  * FORWARD: Sinaliza que é um pacote que será redirecionado para outra interface de rede;

### Alguns [parametros]
* -p: Protocolos
   * tcp
   * udp
   * icmp
* -s: Source
* -j: O que se deve fazer
   * DROP: Nega o pacote sem enviar flag reset (time out);
   * ACCEPT: Aceita pacote;
   * REJECT: Nega pacote mas envia um flag reset (rejected);

### Algumas [extensoes]
* --source-ports: Porta de origem.
* --destination-ports: Porta de destino.
* -icmp-type: Especifica quais os tipos de pacote icmp podem passar ou não pelo firewall.

## Controle de endereços

### Recusar IPs (Criar área vermelha)
Para recusar um pacote de um determinado IP, tal como 10.0.0.5, que utiliza protocolo TCP, podemos usar:
```
iptables -A INPUT -s 10.0.0.5 -p tcp  -j DROP
```

Para recusar uma conexão de um determinado IP que utiliza protocolo TCP, tal como 10.0.0.5, enviando um reset, podemos usar:
```
iptables -A INPUT -s 10.0.0.5 -p tcp  -j REJECT
```

### Permitir IPs (área verde)
Para permitir acesso direto de um determinado IP, como por exemplo o 8.8.8.8, podemos usar:
```
iptables -A INPUT -s 8.8.8.8 -p tcp -j ACCEPT
```
## Controle de Portas e Protocolos de comunicação
Para bloquear um determinado protocolo, por exemplo TCP e UDP, em uma porta 80:
```
iptables -A INPUT -p tcp --destination-ports 80
iptables -A INPUT -p udp --destination-ports 80
```
## Controle de programas
Para bloquear o acesso de um programa à rede, por exemplo o jogo Tibia, é preciso consultar qual a porta do programa. Neste caso, a porta 7171
```
iptables -A INPUT -p tcp --destination-ports 7171
```
