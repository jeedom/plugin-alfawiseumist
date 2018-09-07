import select,socket
import argparse
from time import sleep

parser = argparse.ArgumentParser(description='Script to Control and Read Alfawise Umist')
parser.add_argument("--deviceid", help="Device ID", type=str, default='A020A62FEB70')
parser.add_argument("--deviceip", help="Device IP", type=str, default='255.255.255.255')
parser.add_argument("--action", help="Action", type=str, default='on')
parser.add_argument("--options", help="options", type=str, default='on')
args = parser.parse_args()

bufferSize = 1024
sock = socket.socket(socket.AF_INET, socket.SOCK_DGRAM, socket.IPPROTO_UDP)
sock.setsockopt(socket.IPPROTO_IP, socket.IP_MULTICAST_TTL, 2)
sock.setsockopt(socket.SOL_SOCKET, socket.SO_BROADCAST, 1)
expectedReturn = True

if args.action == 'on':
	sock.sendto('{"command":"comm6","sa_ctrl":"1","deviceid":"'+args.deviceid+'","modelid":"sj07","phoneid":"020000000000","userid":""}', (args.deviceip, 10002))
elif args.action == 'off':
	sock.sendto('{"command":"comm6","sa_ctrl":"0","deviceid":"'+args.deviceid+'","modelid":"sj07","phoneid":"020000000000","userid":""}', (args.deviceip, 10002))
elif args.action == 'speed0':
	sock.sendto('{"command":"comm103","h_rank":"0","deviceid":"'+args.deviceid+'","modelid":"sj07","phoneid":"020000000000","userid":""}', (args.deviceip, 10002))
elif args.action == 'speed1':
	sock.sendto('{"command":"comm103","h_rank":"1","deviceid":"'+args.deviceid+'","modelid":"sj07","phoneid":"020000000000","userid":""}', (args.deviceip, 10002))
elif args.action == 'speed2':
	sock.sendto('{"command":"comm103","h_rank":"2","deviceid":"'+args.deviceid+'","modelid":"sj07","phoneid":"020000000000","userid":""}', (args.deviceip, 10002))
elif args.action == 'count1':
	sock.sendto('{"command":"comm102","countdown":"1","deviceid":"'+args.deviceid+'","modelid":"sj07","phoneid":"020000000000","userid":""}', (args.deviceip, 10002))
elif args.action == 'count3':
	sock.sendto('{"command":"comm102","countdown":"3","deviceid":"'+args.deviceid+'","modelid":"sj07","phoneid":"020000000000","userid":""}', (args.deviceip, 10002))
elif args.action == 'count6':
	sock.sendto('{"command":"comm102","countdown":"6","deviceid":"'+args.deviceid+'","modelid":"sj07","phoneid":"020000000000","userid":""}', (args.deviceip, 10002))
elif args.action == 'light2':
	sock.sendto('{"command":"comm104","l_mode":"2","deviceid":"'+args.deviceid+'","modelid":"sj07","phoneid":"020000000000","userid":""}', (args.deviceip, 10002))
elif args.action == 'light1':
	sock.sendto('{"command":"comm104","l_mode":"1","deviceid":"'+args.deviceid+'","modelid":"sj07","phoneid":"020000000000","userid":""}', (args.deviceip, 10002))
elif args.action == 'light3':
	sock.sendto('{"command":"comm104","l_mode":"3","deviceid":"'+args.deviceid+'","modelid":"sj07","phoneid":"020000000000","userid":""}', (args.deviceip, 10002))
elif args.action == 'color':
	sock.sendto('{"command":"comm101","l_color":"'+args.options+'","leave":"100","deviceid":"'+args.deviceid+'","modelid":"sj07","phoneid":"020000000000","userid":""}', (args.deviceip, 10002))
elif args.action == 'read':
 	expectedReturn = False

if expectedReturn : # Empty socket
	result = select.select([sock],[],[])
	result[0][0].recv(bufferSize)
	sleep(1) # For order takin into account

# Always return last state
sock.sendto('{"command":"comm100","password":"1234","deviceid":"'+args.deviceid+'","modelid":"sj07","phoneid":"020000000000","userid":""}', (args.deviceip, 10002))
result = select.select([sock],[],[])
msg = result[0][0].recv(bufferSize)
print msg
sock.close()

