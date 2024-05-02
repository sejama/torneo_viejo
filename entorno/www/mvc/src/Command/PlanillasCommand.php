<?php 

namespace App\Command;

use App\Repository\PartidoRepository;
use Endroid\QrCode\Builder\Builder;
use Endroid\QrCode\Encoding\Encoding;
use Endroid\QrCode\ErrorCorrectionLevel;
use Endroid\QrCode\Label\Font\NotoSans;
use Endroid\QrCode\Label\Font\OpenSans;
use Endroid\QrCode\Label\LabelAlignment;
use Endroid\QrCode\RoundBlockSizeMode;
use Endroid\QrCode\Writer\PdfWriter;
use Endroid\QrCode\Writer\PngWriter;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use TCPDF;

#[AsCommand(
    name: 'app:crear-planillas',
    description: 'Creador de planillas',
    hidden: false,
    aliases: ['app:crear-planillas']
)]
class PlanillasCommand extends Command
{
    public function __construct(
        private PartidoRepository $partidoRepository
    )
    {
        parent::__construct();
    }
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $partidos = $this->partidoRepository->findAll();

        $pdfTodos = new TCPDF('L', 'mm', 'A4', true, 'UTF-8', false);

        foreach ($partidos as $partido) {
            $output->writeln($partido->getId() . ' - ' . $partido->getEquipoLocal()->getNombre() . ' vs ' . $partido->getEquipoVisitante()->getNombre());
            $result = Builder::create()
                ->writer(new PngWriter())
                ->writerOptions([])
                ->data('https://torneo.sejama.com.ar/partido/'. $partido->getId() .'/editar')
                ->encoding(new Encoding('UTF-8'))
                ->errorCorrectionLevel(ErrorCorrectionLevel::High)
                ->size(300)
                ->margin(10)
                ->roundBlockSizeMode(RoundBlockSizeMode::Margin)
                ->logoPath(__DIR__.'/assets/nuevo.png')
                ->logoResizeToWidth(75)
                ->logoPunchoutBackground(true)
                //->labelText('Partido '. $partido->getId())
                //->labelFont(new OpenSans(30))
                //->labelAlignment(LabelAlignment::Center)
                ->validateResult(false)
                ->build();

            // Save it to a file
            $result->saveToFile(__DIR__.'/assets/qr/partido-'. $partido->getId() .'.png');

            // Generate PDF
            $pdf = new TCPDF('L', 'mm', 'A4', true, 'UTF-8', false);
            
            $pdf->AddPage();
            $pdf->SetMargins(0, 0, 0, true);
            $pdf->SetAutoPageBreak(false, 0);

            $pdfTodos->AddPage();
            $pdfTodos->SetMargins(0, 0, 0, true);
            $pdfTodos->SetAutoPageBreak(false, 0);

            $pdf->Image(__DIR__.'/assets/qr/planilla.png', 0, 0, 310 , 215 , '', '', '', true, 300, '', false, false, 0);
            $pdf->Image(__DIR__.'/assets/qr/partido-'. $partido->getId() .'.png', 260, 4, 29 , 29 , '', '', '', true, 300, '', false, false, 0);

            $pdfTodos->Image(__DIR__.'/assets/qr/planilla.png', 0, 0, 310 , 215 , '', '', '', true, 300, '', false, false, 0);
            $pdfTodos->Image(__DIR__.'/assets/qr/partido-'. $partido->getId() .'.png', 260, 4, 29 , 29 , '', '', '', true, 300, '', false, false, 0);

            $pdf->SetFont('helvetica', 'B', 10);

            $pdfTodos->SetFont('helvetica', 'B', 10);

            //Sede
            $pdf->SetXY(30.5, 32);
            if($partido->getCancha() != null){
                $pdf->Write(0, strtoupper($partido->getCancha()->getClub()->getNombre()));
            }else{
                $pdf->Write(0, 'SIN SEDE');
            }
            
            $pdfTodos->SetXY(30.5, 32);
            if($partido->getCancha() != null){
                $pdfTodos->Write(0, strtoupper($partido->getCancha()->getClub()->getNombre()));
            }else{
                $pdfTodos->Write(0, 'SIN SEDE');
            }
            //Cancha
            $pdf->SetXY(98, 32);
            if($partido->getCancha() != null){
                $pdf->Write(0, strtoupper($partido->getCancha()->getNombre()));
            }else{
                $pdf->Write(0, 'SIN CANCHA');
            }

            $pdfTodos->SetXY(98, 32);
            if($partido->getCancha() != null){
                $pdfTodos->Write(0, strtoupper($partido->getCancha()->getNombre()));
            }else{
                $pdfTodos->Write(0, 'SIN CANCHA');
            }

            //Categoria
            $pdf->SetXY(147, 32);
            $pdf->Write(0, strtoupper($partido->getEquipoLocal()->getTorneoGeneroCategoria()->getCategoria()->getNombre()));

            $pdfTodos->SetXY(147, 32);
            $pdfTodos->Write(0, strtoupper($partido->getEquipoLocal()->getTorneoGeneroCategoria()->getCategoria()->getNombre()));

            //Rama
            $pdf->SetXY(176, 32);
            $pdf->Write(0, strtoupper($partido->getEquipoLocal()->getTorneoGeneroCategoria()->getGenero()->getNombre()));

            $pdfTodos->SetXY(176, 32);
            $pdfTodos->Write(0, strtoupper($partido->getEquipoLocal()->getTorneoGeneroCategoria()->getGenero()->getNombre()));

            //Fecha y Hora
            $pdf->SetXY(236, 32);
            if($partido->getHorario() != null){
                $pdf->Write(0, $partido->getHorario()->format('d/m/Y H:i'));
            }else{
                $pdf->Write(0, 'SIN HORARIO');
            }

            $pdfTodos->SetXY(236, 32);
            if($partido->getHorario() != null){
                $pdfTodos->Write(0, $partido->getHorario()->format('d/m/Y H:i'));
            }else{
                $pdfTodos->Write(0, 'SIN HORARIO');
            }

            // Partido N° XX
            $pdf->setXY(262,35);
            $pdf->Write(0, 'PARTIDO N° '. $partido->getId());

            $pdfTodos->setXY(262,35);
            $pdfTodos->Write(0, 'PARTIDO N° '. $partido->getId());

            //Set 1
            // Ubicacion Local Set 1
            $pdf->SetXY(36, 45.8);
            $pdf->Write(0, $partido->getEquipoLocal()->getNombre());

            $pdfTodos->SetXY(36, 45.8);
            $pdfTodos->Write(0, $partido->getEquipoLocal()->getNombre());
            // Ubicacion Visitante Set 1
            $pdf->SetXY(101, 45.8);
            $pdf->Write(0, $partido->getEquipoVisitante()->getNombre());

            $pdfTodos->SetXY(101, 45.8);
            $pdfTodos->Write(0, $partido->getEquipoVisitante()->getNombre());
            
            //Set 2
             // Ubicacion Local Set 2
            $pdf->SetXY(174, 45.8);
            $pdf->Write(0, $partido->getEquipoLocal()->getNombre());

            $pdfTodos->SetXY(174, 45.8);
            $pdfTodos->Write(0, $partido->getEquipoLocal()->getNombre());
            // Ubicacion Visitante Set 2
            $pdf->SetXY(236, 45.8);
            $pdf->Write(0, $partido->getEquipoVisitante()->getNombre());

            $pdfTodos->SetXY(236, 45.8);
            $pdfTodos->Write(0, $partido->getEquipoVisitante()->getNombre());
            
            //Set 3
            //Ubicacion Local Set 3
            $pdf->SetXY(36, 104.5);
            $pdf->Write(0, $partido->getEquipoLocal()->getNombre());

            $pdfTodos->SetXY(36, 104.5);
            $pdfTodos->Write(0, $partido->getEquipoLocal()->getNombre());
            // Ubicacion Visitante Set 3
            $pdf->SetXY(101, 104.5);
            $pdf->Write(0, $partido->getEquipoVisitante()->getNombre());

            $pdfTodos->SetXY(101, 104.5);
            $pdfTodos->Write(0, $partido->getEquipoVisitante()->getNombre());

            $pdf->Output(__DIR__.'/assets/pdf/partido-'. $partido->getId() .'.pdf', 'F');

        }

        $pdfTodos->Output(__DIR__.'/assets/pdf/Todos.pdf', 'F');
        return Command::SUCCESS;

        
        // return Command::FAILURE;

        
        // return Command::INVALID
    }

    protected function configure(): void
    {
        $this
            // the command description shown when running "php bin/console list"
            ->setDescription('Creador de planillas')
            // the command help shown when running the command with the "--help" option
            ->setHelp('Este comando permite crear planillas de partidos.')
            //->addArgument('csv', InputArgument::REQUIRED, 'Ruta donde se encuentra el archivo CSV con los partidos a crear.')
        ;
    }
}